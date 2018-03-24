<?php

namespace AvoRed\Framework\Tabs;

class Tab
{
    public $type = null;

    public $label = null;

    public $view = null;

    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    public function setLabel($label)
    {
        $this->label = $label;

        return $this;
    }

    public function setViewpath($view)
    {
        $this->view = $view;

        return $this;
    }
}
