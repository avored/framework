<?php

namespace AvoRed\Framework\Order\Controllers;

use Illuminate\View\View;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Order\Mail\SentOrderInvoice;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use AvoRed\Framework\Order\Requests\OrderTrackCodeRequest;
use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Order\Requests\OrderChangeStatusRequest;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use Illuminate\Http\Request;

class OrderController
{
    /**
     * Order Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\OrderRepository
     */
    protected $orderRepository;

    /**
     * Order Repository for the Install Command.
     * @var \AvoRed\Framework\Database\Repository\OrderStatusRepository
     */
    protected $orderStatusRepository;

    /**
     * Construct for the AvoRed install command.
     * @param \AvoRed\Framework\Database\Contracts\OrderModelInterface $orderRepository
     */
    public function __construct(
        OrderModelInterface $orderRepository,
        OrderStatusModelInterface $orderStatusRepository
    ) {
        $this->orderRepository = $orderRepository;
        $this->orderStatusRepository = $orderStatusRepository;
    }

    /**
     * Show Dashboard of an AvoRed Admin.
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->paginate(10, ['customer', 'orderStatus']);
        $orderStatuses = $this->orderStatusRepository->all()->pluck('name', 'id');

        return view('avored::order.order.index')
            ->with('orderStatuses', $orderStatuses)
            ->with('orders', $orders);
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Order\Requests\OrderChangeStatusRequest  $request
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function changeStatus(OrderChangeStatusRequest $request, Order $order)
    {
        $order->update($request->all());

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::order.order.index.title')]
            ),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     * @param \AvoRed\Framework\Order\Requests\OrderTrackCodeRequest  $request
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return \Illuminate\Http\JsonResponse
     */
    public function saveTrackCode(OrderTrackCodeRequest $request, Order $order)
    {
        $order->update($request->all());

        return response()->json([
            'success' => true,
            'message' => __(
                'avored::system.notification.updated',
                ['attribute' => __('avored::order.order.index.title')]
            ),
        ]);
    }

    /**
     * Show Order Details.
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order): View
    {
        $order->load('orderComments.commentable');
       
        return view('avored::order.order.show')
            ->with(compact('order'));
    }

    /**
     * Download Order Invoice in PDF.
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function downloadInvoice(Order $order): BinaryFileResponse
    {
     
        $path = $this->generatePDF($order);

        return response()->download($path, 'invoice.pdf');
    }

    /**
     * Download Order Invoice in PDF.
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return  \Illuminate\Http\RedirectResponse
     */
    public function emailInvoice(Order $order)
    {
        $path = $this->generatePDF($order);
        $email = $order->customer->email;

        Mail::to($email)
            ->send(
                new SentOrderInvoice($path)
            );

        return redirect()->route('admin.order.index');
    }

    /**
     * Generate PDF Invoice for the Given Order.
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function generateShippingLabel(Order $order): BinaryFileResponse
    {
        $folderPath = storage_path('app/public/uploads/orders');
        File::makeDirectory($folderPath, 0755, true, true);
        $path = $folderPath.'/shipping-label-'.$order->id.'.pdf';
        if (! File::exists($path)) {
            $html = view('avored::order.order.shipping-label')
                ->with(compact('order'))
                ->render();

            PDF::loadHtml($html)
                ->setPaper('a4')
                ->save($path);
        }

        return response()->download($path, 'shipping-label.pdf');
    }

    /**
     * Generate PDF Invoice for the Given Order.
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return string
     */
    protected function generatePDF(Order $order): string
    {
        $folderPath = storage_path('app/public/uploads/orders');
        File::makeDirectory($folderPath, 0755, true, true);
        $path = $folderPath.'/invoice-'.$order->id.'.pdf';

        if (! File::exists($path)) {
            $html = view('avored::order.order.invoice')
                ->with(compact('order'))
                ->render();

            PDF::loadHtml($html)
                ->setPaper('a4')
                ->save($path);
        }

        return $path;
    }

    
    /**
     * Filter for Category Table.
     * @return \Illuminate\View\View
     */
    public function filter(Request $request)
    {
        return $this->orderRepository->filter($request->get('filter'));
    }
}
