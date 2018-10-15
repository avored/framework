<?php

namespace AvoRed\Framework\Tabs;

class Tab
{
    /**
     * Tab Type e.g: Product, CMS, Order or etc
     *
     * @var string $type
     */
    public $type = null;

    /**
     * Tab Label
     *
     * @var string $label
     */
    public $label = null;

    /**
     * Tab View
     *
     * @var string $view
     */
    public $view = null;

    /**
     * get/set Tab Type e.g: Product, CMS, Order
     *
     * @var null|string $type
     */
    public function type($type = null)
    {
        if (null === $type) {
            return $this->type;
        }

        $this->type = $type;
        return $this;
    }

    /**
     * get/set Tab Label
     *
     * @var null|string $label
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
     * get/set Tab View
     *
     * @var null|string $view
     */
    public function view($view = null)
    {
        if (null === $view) {
            return $this->view;
        }

        $this->view = $view;

        return $this;
    }
}
