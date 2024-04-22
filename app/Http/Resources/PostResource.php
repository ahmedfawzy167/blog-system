<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $posts = $this->resource->items();

        return [
           'status' => 200,
           'data' => array_map(function ($post) {
               return [
                   'id' => $post->id,
                   'title' => $post->title,
                   'description' => $post->description,
                   'category_id' => $post->category->name,
                   'image' => $post->image,
                   'created_at' => $post->created_at,
                   'updated_at' => $post->updated_at,
               ];
           }, $posts),
           'pagination' => [
               'total' => $this->resource->total(),
               'per_page' => $this->resource->perPage(),
               'current_page' => $this->resource->currentPage(),
               'last_page' => $this->resource->lastPage(),
               'next_page_url' => $this->resource->nextPageUrl(),
               'prev_page_url' => $this->resource->previousPageUrl(),
           ],
       ];

    }
}
