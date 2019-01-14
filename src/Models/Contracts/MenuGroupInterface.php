<?php

namespace AvoRed\Framework\Models\Contracts;

interface MenuGroupInterface
{
    /**
     * Find an Menu Group by given Id which returns MenuGroup
     *
     * @param $id
     * @return \AvoRed\Framework\Models\MenuGroup
     */
    public function find($id);

    /**
     * Find an All MenuGroup which returns Eloquent Collection
     *
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function all();

    /**
     * MenuGroup Query Builder
     *
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query();

    /**
     * Create a MenuGroup
     *
     * @param array $data
     * @return \AvoRed\Framework\Models\MenuGroup
     */
    public function create($data);
}
