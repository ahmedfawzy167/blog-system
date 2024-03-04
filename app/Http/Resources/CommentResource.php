<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $comments = $this->resource->items();

        return [
            'status' => 200,
            'data' => array_map(function ($comment) {
               return [
                   'id' => $comment->id,
                   'post_id' => $comment->post->title,
                   'user_id' => $comment->user->name,
                   'contnet' => $comment->content,
                   'created_at' => $comment->created_at,
                   'updated_at' => $comment->updated_at,
               ];
           }, $comments),
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
