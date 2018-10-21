<?php

namespace AvoRed\Framework\Api\Resources\Attribute;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * Class \AvoRed\Framework\Api\Resources\AttributeAttributeResource
 * @property int id
 * @property string name
 * @property string identifier
 * @property array attributeDropdownOptions
 * @property string created_at
 * @property string updated_at
 */
class AttributeResource extends JsonResource
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
            'dropdown_options' => new AttributeDropdownOptionCollectionResource($this->attributeDropdownOptions),
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
    public function with($request)
    {
        return [
            'status' => 'success'
        ];
    }
}
