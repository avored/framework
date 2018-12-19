<?php

namespace AvoRed\Framework\Product\Widget;

use AvoRed\Framework\Widget\Contracts\Widget as WidgetContract;
use AvoRed\Framework\Models\Contracts\OrderInterface;
use Carbon\Carbon;

class MonthlyRevenueWidget implements WidgetContract
{
    /**
     * Widget View Path.
     *
     * @var string
     */
    protected $view = 'avored-framework::widget.monthly-revenue';

    /**
     * Widget Label.
     *
     * @var string
     */
    protected $label = 'Monthly Revenue';

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
    protected $identifier = 'monthly-revenue';

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
        $monthlyRevenue = 0;
        $orderRepository = app(OrderInterface::class);
        $lastMonth = Carbon::now()->subMonths(1);

        $orders = $orderRepository->query()
                        ->where('created_at', '>=', $lastMonth)
                        ->get();

        foreach ($orders as $order) {
            foreach ($order->products as $product) {
                $monthlyRevenue += $product->price - $product->cost_price;
            }
        }
        $currencySymbol = 'R$';
        //$monthlyRevenue = rand(100, 200);

        return ['monthlyRevenue' => number_format($monthlyRevenue, 2), 'currencySymbol' => $currencySymbol];
    }

    /**
     * @return string
     */
    public function render(): string
    {
        $view = view($this->view())->with($this->with());

        return $view->render();
    }
}
