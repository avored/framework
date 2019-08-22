<?php
namespace AvoRed\Framework\Order\Controllers;

use AvoRed\Framework\Order\Mail\SentOrderInvoice;
use AvoRed\Framework\Database\Contracts\OrderModelInterface;
use AvoRed\Framework\Database\Contracts\OrderStatusModelInterface;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Order\Requests\OrderChangeStatusRequest;
use Barryvdh\DomPDF\Facade as PDF;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class OrderController
{
    /**
     * Order Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\OrderRepository $orderRepository
     */
    protected $orderRepository;
    
    /**
     * Order Repository for the Install Command
     * @var \AvoRed\Framework\Database\Repository\OrderStatusRepository $orderStatusRepository
     */
    protected $orderStatusRepository;
    
    /**
     * Construct for the AvoRed install command
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
     * Show Dashboard of an AvoRed Admin
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->all();
        $orderStatuses = $this->orderStatusRepository->all();

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
            )
        ]);
    }

    /**
     * Show Order Details
     * @param \AvoRed\Framework\Database\Models\Order  $order
     * @return \Illuminate\View\View
     */
    public function show(Order $order): View
    {
        return view('avored::order.order.show')
            ->with('order', $order);
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
        $email = $order->user->email;

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
        $path = $folderPath . '/shipping-label-' . $order->id . '.pdf';
        if (!File::exists($path)) {
            $html = view('avored::order.order.shipping-label')
                ->with('order', $order)
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
        $path = $folderPath . '/invoice-' . $order->id . '.pdf';

        if (!File::exists($path)) {
            $html = view('avored::order.order.invoice')
                ->with('order', $order)
                ->render();
    
            PDF::loadHtml($html)
                ->setPaper('a4')
                ->save($path);
        }

        return $path;
    }
}
