<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
{
    $likes = $this->resource->items();

        return [
           'status' => 200,
           'data' => array_map(function ($like) {
               return [
                   'id' => $like->id,
                   'post_id' => $like->post->title,
                   'user_id' => $like->user->name,
                   'comment_id' => $like->comment->content,
                   'created_at' => $like->created_at,
                   'updated_at' => $like->updated_at,
               ];
           }, $likes),
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

