<?php

namespace AvoRed\Framework\Models\Contracts;

interface PropertyInterface
{
    /**
     * Find a Product Property Model of a given Id
     *
     * @param integer $id
     * @return \AvoRed\Framework\Models\Database\Property
     */
    public function find($id);

    /**
    * Product Property Query Builder
    *
    * @return \Illuminate\Database\Eloquent\Builder
    */
    public function query();
}
