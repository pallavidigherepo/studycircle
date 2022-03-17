<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class BlogResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'slug' => $this->slug,
            'url' => $this->url ? $this->url : $this->slug,
            'content' => $this->content,
            'created_at' => $this->created_at,
            'modified_at' => $this->modified_at,
        ];
        //return parent::toArray($request);
    }
}
