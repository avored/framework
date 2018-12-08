<?php
/**
 * Created by PhpStorm.
 * User: ludio
 * Date: 08/12/18
 * Time: 13:30
 */

namespace AvoRed\Framework\Order\Services;


use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use AvoRed\Framework\Mail\OrderInvoicedMail;
use AvoRed\Framework\Models\Database\Order as Model;

class OrderService
{
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

}