<?php

namespace AvoRed\Framework\Api\Resources\Order;

use Illuminate\Http\Resources\Json\JsonResource;
use AvoRed\Framework\Api\Resources\User\UserResource;
use AvoRed\Framework\Api\Resources\User\UserAddressResource;
use AvoRed\Framework\Api\Resources\Order\OrderProductCollectionResource;
use Illuminate\Database\Eloquent\Collection;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        $products = Collection::make([]);
        foreach ($this->products as $product) {
           
            $products->push([
                'id'=> $product->id,
                'qty'=> $product->getRelationValue('pivot')->qty,
                'price'=> $product->getRelationValue('pivot')->price,
                'tax_amount'=> $product->getRelationValue('pivot')->tax_amount,
            ]);
        }
        
        return [
            'id' => $this->id,
            'shipping_option' => $this->shipping_option,
            'payment_option' => $this->payment_option,
            'user' => new UserResource($this->user),
            'shipping_address' => new UserAddressResource($this->shipping_address),
            'billing_address' => new UserAddressResource($this->billing_address),
            'products' => new OrderProductCollectionResource($products),
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