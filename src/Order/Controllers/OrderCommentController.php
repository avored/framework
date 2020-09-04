<?php

namespace AvoRed\Framework\Order\Controllers;

use AvoRed\Framework\Database\Contracts\OrderCommentModelInterface;
use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Order\Mail\OrderCommentMail;
use AvoRed\Framework\Order\Requests\OrderCommentRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class OrderCommentController
{
    /**
     * Order Comment Repository
     * @param OrderCommentRepository $orderCommentRepository
     */
    protected $orderCommentRepository;


    /**
     * Order Comment Construct
     * @param OrderCommentRepository $orderCommentRepository
     */
    public function __construct(OrderCommentModelInterface $orderCommentRepository)
    {
        $this->orderCommentRepository = $orderCommentRepository;
    }

    /**
     * Store Order Comment into database
     * @param Order $order
     * @param OrderCommentRequest $request
     * @return Redirect
     */
    public function store(Order $order, OrderCommentRequest $request)
    {
        $data = $request->all();
        $data['order_id'] = $order->id;
        $data['commentable_id'] = Auth::guard('admin')->user()->id;
        $data['commentable_type'] = AdminUser::class;
    
        // $this->orderCommentRepository->create($data);
        $email = $order->customer->email;
        $url = route('account.order.show', $order->id);
        Mail::to($email)->send(new OrderCommentMail($url));

        //Sent an email here
        return redirect()->route('admin.order.show', $order->id);
    }
}
