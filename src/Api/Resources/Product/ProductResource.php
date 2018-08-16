<?php

namespace AvoRed\Framework\Api\Resources\Product;

use Illuminate\Http\Resources\Json\JsonResource;
use AvoRed\Framework\Api\Resources\Property\PropertyCollectionResource;
use AvoRed\Framework\Api\Resources\Attribute\AttributeCollectionResource;

class ProductResource extends JsonResource
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
            'type' => $this->type,
            'name' => $this->name,
            'slug' => $this->slug,
            'sku' => $this->sku,
            'description' => $this->description,
            'status' => $this->status,
            'in_stock' => $this->in_stock,
            'track_stock' => $this->track_stock,
            'price' => $this->price,
            'qty' => $this->qty,
            'is_taxable' => $this->is_taxable,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
            'weight' => $this->weight,
            'width' => $this->width,
            'height' => $this->height,
            'length' => $this->length,
            'properties' => new PropertyCollectionResource($this->getPropertiesAll()),
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