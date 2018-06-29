<?php

namespace AvoRed\Framework\DataGrid\Contracts;

interface Column
{
    /**
     * Get the column identifier.
     * @return string $identifier
     */
    public function identifier($identifier);

    /**
     * Get the column label.
     * @return string $label
     */
    public function label($label);

    /**
     * Get the column type.
     * @return string $type
     */
    public function type($type);

    /**
     * Is column sortable?
     * @return string $order
     */
    public function sortable($order);
}
