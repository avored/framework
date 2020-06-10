<?php
namespace AvoRed\Framework\Widget;

use AvoRed\Framework\Support\Contracts\WidgetInterface;

class Widget implements WidgetInterface
{
    /**
     * Label For Widget
     * @var string
     */
    public $label = null;

    /**
     * Type For Widget
     * @var string
     */
    public $type = null;
    /**
     * Callback for this Widget
     * @var string
     */
    protected $callable = null;

    /**
     * Construct for the Widget Info Class
     * @param callable
     * @return void
     */
    public function __construct($callable)
    {
        $this->callable = $callable;
        $callable($this);
    }

    /**
     * SET/GET Widget Label
     * @param string $label
     * @return mixed
     */
    public function label($label = null)
    {
        if (null === $label) {
            return $this->label;
        }
        $this->label = $label;
        return $this;
    }

    /**
     * SET/GET Widget type
     * @param string $label
     * @return mixed
     */
    public function type($type = null)
    {
        if (null === $type) {
            return $this->type;
        }
        $this->type = $type;
        return $this;
    }
}
