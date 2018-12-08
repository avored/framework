<?php

namespace AvoRed\Framework\Order\Widget;

use AvoRed\Framework\Models\Database\Order;
use AvoRed\Framework\Widget\Contracts\Widget as WidgetContract;

class TotalOrderWidget implements WidgetContract
{
    /**
     * Widget View Path.
     *
     * @var string
     */
    protected $view = 'avored-framework::widget.total-order';

    /**
     * Widget Label.
     *
     * @var string
     */
    protected $label = 'Total Pedido';

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
    protected $identifier = 'total-order';

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
        $totalUser = Order::all()->count();

        return ['totalOrder' => $totalUser];
    }
}
