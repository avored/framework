<?php

namespace AvoRed\Framework\Api\Resources\Attribute;

use Illuminate\Http\Resources\Json\ResourceCollection;

class AttributeDropdownOptionCollectionResource extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'data' => $this->collection,
        ];
    }
}
