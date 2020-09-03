<?php

namespace AvoRed\Framework\Order\Controllers;

use AvoRed\Framework\Database\Contracts\OrderCommentModelInterface;
use AvoRed\Framework\Database\Models\AdminUser;
use AvoRed\Framework\Database\Models\Order;
use AvoRed\Framework\Order\Requests\OrderCommentRequest;
use Illuminate\Support\Facades\Auth;

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
     * @param int $orderId //Do not need route binding at this stage.
     * @param OrderCommentRequest $request
     * @return Redirect
     */
    public function store($orderId, OrderCommentRequest $request)
    {
        $data = $request->all();
        $data['order_id'] = $orderId;
        $data['commentable_id'] = Auth::guard('admin')->user()->id;
        $data['commentable_type'] = AdminUser::class;
    
        $this->orderCommentRepository->create($data);

        return redirect()->route('admin.order.show', $orderId);
    }
}
