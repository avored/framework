<?php

namespace AvoRed\Framework\Models\Contracts;

interface ProductInterface
{
    /**
     * Find a model of a given Id
     *
     * @param integer $id
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function find($id);

    /**
     * Find a model of a given slug
     *
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Model
     */
    public function findBySlug($slug);

    /**
     * Product Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();
}
