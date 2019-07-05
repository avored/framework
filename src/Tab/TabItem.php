<?php
namespace AvoRed\Framework\Tab;

class TabItem
{
    /**
     * @var string $label
     */
    protected $label;

    /**
     * @var string $view
     */
    protected $view;

    /**
     * @var string $key
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
     * @return \AvoRed\Framework\Tab\Tab|string
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
     * @return \AvoRed\Framework\Tab\Tab|string
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
     * @return \AvoRed\Framework\Tab\Tab|string
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
