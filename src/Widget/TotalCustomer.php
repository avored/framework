<?php
namespace AvoRed\Framework\Widget;

class TotalCustomer
{
    /**
     * @var string $label
     */
    protected $label = 'Total Customer';

    /**
     * Get/Set label for the Widget
     * @param string mixed $label
     * @return mixed
     */
    public function label($label = null)
    {
        if ($label === null) {
            return $this->label;
        }
        $this->label = $label;
        return $this;
    }

    /**
     * Get/Set label for the Widget
     * @param string mixed $label
     * @return mixed
     */
    public function render()
    {
        return 'total customer render';
    }
}
