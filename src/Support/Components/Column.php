<?php
namespace AvoRed\Framework\Support\Components;

use Illuminate\Support\Arr;

class Column
{
    protected $identifier;
    protected $label;
    protected $visible;
    protected $isRenderable = false;


    public function identifier($identifier = null)
    {
        if ($identifier === null) {
            return $this->identifier;
        }

        $this->identifier = $identifier;

        return $this;
    }
    public function label($label = null)
    {
        if ($label === null) {
            return $this->label;
        }

        $this->label = $label;

        return $this;
    }
    public function visible($visible = null)
    {
        if ($visible === null) {
            return $this->visible;
        }

        $this->visible = $visible;

        return $this;
    }

    public function render($item)
    {
        if (is_callable($item)) {
            $this->isRenderable = true;
            
            return $item();
        }
        $identifier= $this->identifier();

        return Arr::get($item, $identifier);
    }
}
