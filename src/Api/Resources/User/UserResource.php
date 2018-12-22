<?php

namespace AvoRed\Framework\Api\Resources\User;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * Class \AvoRed\Framework\Api\Resources\User\UserResource
 * @property int id
 * @property string first_name
 * @property string last_name
 * @property string email
 * @property string phone
 * @property string company_name
 * @property string image_path
 * @property int status
 * @property string language
 * @property \Illuminate\Database\Eloquent\Collection addresses
 * @property string created_at
 * @property string updated_at
 */
class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'email' => $this->email,
            'phone' => $this->phone,
            'company_name' => $this->company_name,
            'image_path' => $this->image_path,
            'status' => $this->status,
            'language' => $this->language,
            'address' => $this->addresses,
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
