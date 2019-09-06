<?php

namespace AvoRed\Framework\Database\Repository;

use Illuminate\Database\Eloquent\Collection;
use AvoRed\Framework\Database\Models\TaxGroup;
use AvoRed\Framework\Database\Contracts\TaxGroupModelInterface;

class TaxGroupRepository implements TaxGroupModelInterface
{
    /**
     * Create TaxGroup Resource into a database.
     * @param array $data
     * @return \AvoRed\Framework\Database\Models\TaxGroup $taxGroups
     */
    public function create(array $data): TaxGroup
    {
        return TaxGroup::create($data);
    }

    /**
     * get all user groups for.
     * @return \Illuminate\Database\Eloquent\Collection $taxGroups
     */
    public function all() : Collection
    {
        return TaxGroup::all();
    }
}
