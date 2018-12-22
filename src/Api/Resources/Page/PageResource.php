<?php

namespace AvoRed\Framework\Api\Resources\Page;

use Illuminate\Http\Resources\Json\JsonResource;

/**
 *
 * Class \AvoRed\Framework\Api\Resources\Page\PageResource
 * @property int id
 * @property string name
 * @property string slug
 * @property string content
 * @property string meta_title
 * @property string meta_description
 * @property string created_at
 * @property string updated_at
 */
class PageResource extends JsonResource
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
            'slug' => $this->slug,
            'content' => $this->content,
            'meta_title' => $this->meta_title,
            'meta_description' => $this->meta_description,
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
