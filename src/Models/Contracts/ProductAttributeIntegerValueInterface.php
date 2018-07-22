<?php

namespace AvoRed\Framework\Models\Contracts;

interface ProductAttributeIntegerValueInterface
{
    /**
     * Create an Attribute
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\Database\ProductAttributeIntegerValue
     */
    public function create($data);
}
