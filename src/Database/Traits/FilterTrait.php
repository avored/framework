<?php

namespace AvoRed\Framework\Database\Traits;

trait FilterTrait
{
    /**
     * Filter the Data for Category Filter
     * @string $filter
     */
    public function filter($filter)
    {
        $query = $this->query();
        $isFirst = true;
        foreach ($this->filterFields as $filed) 
        {
            if ($isFirst) {
                $query->where($filed, 'like', '%'. $filter .'%' );
                $isFirst = false;
            } else {
                $query->orWhere($filed, 'like', '%'. $filter .'%' );
            }
        }

        return $query->paginate($this->perPage);
    }
}
