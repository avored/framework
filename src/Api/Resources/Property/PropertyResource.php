<?php

namespace AvoRed\Framework\Api\Resources\Property;

use AvoRed\Framework\Api\Resources\Property\PropertyDropdownOptionCollectionResource;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
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
            'id' => $this->id,
            'name' => $this->name,
            'identifier' => $this->identifier,
            'data_type' => $this->data_type,
            'field_type' => $this->field_type,
            'sort_order' => $this->sort_order,
            'dropdown_options' => $this->when($this->field_type == "SELECT", new PropertyDropdownOptionCollectionResource($this->propertyDropdownOptions)),
            'use_for_all_products' => $this->use_for_all_products,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }

    /**
     * Added a Status Success with Response
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function with($request){

        return [
          'status'=>'success'
        ];
    }
}