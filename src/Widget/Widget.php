<?php

namespace AvoRed\Framework\Widget;

use AvoRed\Framework\Widget\Contracts\Widget as WidgetContracts;

class Widget implements WidgetContracts
{
    /**
     * Label For Widget.
     *
     * @var string
     */
    public $label = null;

    /**
     * Type For Widget.
     *
     * @var string
     */
    public $type = null;

    /**
     * Callback for this Widget.
     *
     * @var string
     */
    protected $callable = null;

    public function __construct($callable)
    {
        $this->callback = $callable;

        $callable($this);
    }

    public function label($label = null)
    {
        if (null === $label) {
            return $this->label;
        }
        $this->label = $label;

        return $this;
    }

    public function type($type = null)
    {
        if (null === $type) {
            return $this->type;
        }
        $this->type = $type;

        return $this;
    }
}
