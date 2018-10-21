<?php

namespace AvoRed\Framework\Order\Controllers;

use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use AvoRed\Framework\Models\Database\User;
use AvoRed\Framework\Models\Database\Order as Model;
use AvoRed\Framework\Models\Database\OrderStatus;
use AvoRed\Framework\Mail\OrderInvoicedMail;
use AvoRed\Framework\Mail\UpdateOrderStatusMail;
use AvoRed\Framework\Order\DataGrid\OrderDataGrid;
use AvoRed\Framework\Order\Requests\UpdateOrderStatusRequest;
use AvoRed\Framework\Order\Requests\UpdateTrackCodeRequest;
use AvoRed\Framework\Models\Contracts\OrderInterface;
use AvoRed\Framework\Models\Contracts\OrderHistoryInterface;
use AvoRed\Framework\System\Controllers\Controller;

class OrderController extends Controller
{
    /**
     *
     * @var \AvoRed\Framework\Models\Repository\OrderRepository
     */
    protected $repository;

    public function __construct(OrderInterface $repository)
    {
        $this->repository = $repository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orderGrid = new OrderDataGrid($this->repository->query()->orderBy('id', 'desc'));

        return view('avored-framework::order.index')->with('dataGrid', $orderGrid->dataGrid);
    }

    /**
     * View an Order Details
     * @param \AvoRed\Framework\Models\Database\Order $order
     *
     * @return \Illuminate\Http\Response
     */
    public function view(Model $order)
    {
        $orderStatus = OrderStatus::all()->pluck('name', 'id');
        return view('avored-framework::order.view')->with('order', $order)->with('orderStatus', $orderStatus);
    }

    /**
     * Send an Order Invioced PDF to User
     *
     * @param \AvoRed\Framework\Models\Database\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function sendEmailInvoice(Model $order)
    {
        $user = $order->user;
        $view = view('avored-framework::mail.order-pdf')->with('order', $order);

        $folderPath = storage_path('app/public/uploads/order/invoice');
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, '0775', true, true);
        }
        $path = $folderPath . DIRECTORY_SEPARATOR . $order->id . '.pdf';
        PDF::loadHTML($view->render())->save($path);

        Mail::to($user->email)->send(new OrderInvoicedMail($order, $path));

        return redirect()->back()->with('notificationText', 'Email Sent Successfully!!');
    }

    /**
     * Edit the Order Status View
     *
     * @param \AvoRed\Framework\Models\Database\Order $order
     * @return \Illuminate\Http\Response
     */
    public function editStatus(Model $order)
    {
        $orderStatus = OrderStatus::all()->pluck('name', 'id');

        $view = view('avored-framework::order.view')
            ->with('order', $order)
            ->with('orderStatus', $orderStatus)
            ->with('changeStatus', true);

        return $view;
    }

    /**
     * Change the Order Status
     *
     * @param \AvoRed\Framework\Models\Database\Order $order
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateStatus(Model $order, UpdateOrderStatusRequest $request)
    {
        //$order = Model::find($id);
        $order->update($request->all());

        $userEmail = $order->user->email;
        $orderStatusTitle = $order->orderStatus->name;

        $orderHistoryRepository = app(OrderHistoryInterface::class);
        $orderHistoryRepository->create(['order_id' => $order->id, 'order_status_id' => $request->get('order_status_id')]);

        Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));

        return redirect()->route('admin.order.index');
    }

    /**
     * Change the Order Status
     *
     * @param \AvoRed\Framework\Models\Database\Order $order
     * @param \AvoRed\Framework\Order\Request\UpdateTrackCodeRequest $request
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function updateTrackCode(Model $order, UpdateTrackCodeRequest $request)
    {
        $order->update(['track_code' => $request->track_code]);

        //Mail::to($userEmail)->send(new UpdateOrderStatusMail($orderStatusTitle));

        return redirect()->route('admin.order.index');
    }
}
