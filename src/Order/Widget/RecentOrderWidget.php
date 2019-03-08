<?php

namespace AvoRed\Framework\Order\Widget;

use AvoRed\Framework\Widget\Contracts\Widget as WidgetContract;
use AvoRed\Framework\Models\Contracts\OrderInterface;

class RecentOrderWidget implements WidgetContract
{
    /**
     * Widget View Path.
     *
     * @var string
     */
    protected $view = 'avored-framework::widget.recent-order';

    /**
     * Widget Label.
     *
     * @var string
     */
    protected $label = 'Recent Order';

    /**
     * Widget Type.
     *
     * @var string
     */
    protected $type = 'dashboard';

    /**
     * Widget unique identifier.
     *
     * @var string
     */
    protected $identifier = 'recent-order';

    public function view()
    {
        return $this->view;
    }

    /*
     * Widget unique identifier
     *
     */
    public function identifier()
    {
        return $this->identifier;
    }

    /*
    * Widget unique identifier
    *
    */
    public function label()
    {
        return $this->label;
    }

    /*
    * Widget unique identifier
    *
    */
    public function type()
    {
        return $this->type;
    }

    /**
     * View Required Parameters.
     *
     * @return array
     */
    public function with()
    {
        $recentOrder = null;

        $order = app(OrderInterface::class);

        $latestOrder = $order->query()->orderBy('id', 'desc')->first();
        if ($latestOrder !== null) {
            $totalAmount = '';
            foreach ($latestOrder->products as $product) {
                $totalAmount = $product->getRelationValue('pivot')->qty * $product->getRelationValue('pivot')->price;
            }

            $recentOrder['order_id'] = $latestOrder->id;
            $recentOrder['user'] = $latestOrder->user->fullName;
            $recentOrder['customer_id'] = $latestOrder->user->id;
            $recentOrder['product_count'] = $latestOrder->products->count();
            $recentOrder['total_amount'] = $totalAmount;
            $recentOrder['status'] = $latestOrder->orderStatus->name;
        }

        return ['recentOrderData' => $recentOrder];
    }
}
