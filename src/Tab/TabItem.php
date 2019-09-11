<?php

namespace AvoRed\Framework\Tab;

class TabItem
{
    /**
     * @var string
     */
    protected $label;

    /**
     * @var string
     */
    protected $view;

    /**
     * @var string
     */
    protected $key;

    /**
     *  AvoRed Front Tab Construct method.
     * @param callable $callable
     */
    public function __construct(callable $callable)
    {
        $callable($this);
    }

    /**
     * Get/Set Tab Label.
     * @return mixed
     */
    public function label($label = null)
    {
        if (null !== $label) {
            $this->label = $label;

            return $this;
        }

        return trans($this->label);
    }

    /**
     * Get/Set Tab View.
     * @return mixed
     */
    public function view($view = null)
    {
        if (null !== $view) {
            $this->view = $view;

            return $this;
        }

        return $this->view;
    }

    /**
     * Get/Set Tab Identifier.
     * @return mixed
     */
    public function key($key = null)
    {
        if (null !== $key) {
            $this->key = $key;

            return $this;
        }

        return $this->key;
    }
}
