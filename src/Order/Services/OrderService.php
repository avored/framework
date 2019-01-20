<?php
/**
 * Created by PhpStorm.
 * User: ludio
 * Date: 08/12/18
 * Time: 13:30
 */

namespace AvoRed\Framework\Order\Services;


use Illuminate\Support\Facades\Auth;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use AvoRed\Framework\Mail\OrderInvoicedMail;
use AvoRed\Framework\Models\Database\Order as Model;
use AvoRed\Framework\Cart\Facade as Cart;
use AvoRed\Framework\Models\Contracts\ConfigurationInterface;
use AvoRed\Framework\Models\Contracts\OrderHistoryInterface;
use AvoRed\Framework\Models\Contracts\OrderReturnProductInterface;
use AvoRed\Framework\Models\Contracts\OrderReturnRequestInterface;
use AvoRed\Framework\Models\Contracts\ProductInterface;
use AvoRed\Framework\Models\Database\Address;
use AvoRed\Framework\Models\Database\Order;
use AvoRed\Framework\Models\Database\OrderProductVariation;
use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Framework\Models\Database\Product;
use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\Payment\Facade as Payment;
use AvoRed\Framework\Shipping\Facade as Shipping;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Session;


class OrderService
{
    /**
     * @param Order $order
     *
     * @return bool
     */
    public function sendEmailInvoice(Model $order)
    {
        try {
            $user = $order->user;
            $view = view('avored-framework::mail.order-pdf')->with('order', $order);

            $folderPath = storage_path('app/public/uploads/order/invoice');
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, '0775', true, true);
            }
            $path = $folderPath . DIRECTORY_SEPARATOR . $order->id . '.pdf';
            PDF::loadHTML($view->render())->save($path);

            Mail::to($user->email)->send(new OrderInvoicedMail($order, $path));
            return true;
        }
        catch (\Exception $e)
        {
            return false;
        }
    }


    private function findAddress($addressData)
    {
        $address = Address::query();
        foreach ($addressData as $key => $value) {
            $address->where($key, $value);
        }
        return $address->first();
    }



    /**
     * @param $request
     *
     * @return mixed
     */
    public function getUser($request)
    {
        if (Auth::guard()->check()) {
            return Auth::user();
        }
        $userData = $request->get('user');

        $user = User::whereEmail($userData['email'])->first();

        if (null === $user) {
            $billingData = $request->get('billing');
            $userData = $request->get('user');
            $userData['password'] = bcrypt($userData['password']);
            $userData['first_name'] = $billingData['first_name'];
            $userData['last_name'] = $billingData['last_name'];
            $user = User::create($userData);
        }

        Auth::guard('web')->loginUsingId($user->id);

        return $user;
    }


    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getBillingAddress($request)
    {
        $billingData = $request->get('billing');

        $billingData['type'] = 'BILLING';
        $billingData['user_id'] = Auth::guard()->user()->id;

        //dd($this->findAddress($billingData));

        if (!empty($this->findAddress($billingData))) {
            $address = $this->findAddress($billingData);
        }
        else if (isset($billingData['id']) && $billingData['id'] > 0) {
            $address = Address::findorfail($billingData['id']);
            //$address->update($shippingData);
        }

        else {
            $address = Address::create($billingData);
        }

        return $address;
    }




    /**
     * @param Request $request
     *
     * @return mixed
     */
    public function getShippingAddress($request)
    {
        if (null == $request->get('use_different_shipping_address')) {
            $shippingData = $request->get('billing');
        } else {
            $shippingData = $request->get('shipping');
        }

        $shippingData['type'] = 'SHIPPING';
        $shippingData['user_id'] = Auth::guard()->user()->id;

        if (isset($shippingData['id']) && $shippingData['id'] > 0) {
            $address = Address::findorfail($shippingData['id']);
            //$address->update($shippingData);
        } else {
            $address = Address::create($shippingData);
        }

        return $address;
    }



    /**
     * @param $order
     * @param $orderProducts
     *
     *
     */
    public function syncOrderProductData($order, $orderProducts)
    {
        $orderProductTableData = [];

        foreach ($orderProducts as $orderProduct) {


            if (null !== $orderProduct->attributes() && count($orderProduct->attributes())) {
                foreach ($orderProduct->attributes() as $attribute) {
                    $product = Product::whereSlug($orderProduct->slug())->first();
                    $data = [
                        'order_id'                     => $order->id,
                        'product_id'                   => $product->id,
                        'attribute_dropdown_option_id' => $attribute['attribute_dropdown_option_id'],
                        'attribute_id'                 => $attribute['attribute_id'],
                    ];

                    OrderProductVariation::create($data);

                    $productVariationModel = Product::find($attribute['variation_id']);
                    $productVariationModel->update(['qty' => ($productVariationModel->qty - $orderProduct->qty())]);
                }
            } else {
                $product = Product::whereSlug($orderProduct->slug())->first();
                $product->update(['qty' => ($product->qty - $orderProduct->qty())]);
            }

            $orderProductTableData[] = [
                'product_id'   => $product->id,
                'qty'          => $orderProduct->qty(),
                'price'        => $orderProduct->price(),
                'tax_amount'   => 0.00,
                'product_info' => $product->toJson()

            ];
        }
        $order->products()->sync($orderProductTableData);
    }


}
