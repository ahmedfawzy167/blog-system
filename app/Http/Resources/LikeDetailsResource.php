<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class LikeDetailsResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
       return [
        'status' => 200,
        'data' => [
        'user_id' => $this->user->name,
        'post_id' =>  $this->post->title,
        'comment_id' => $this->comment->content,
        'created_at' => $this->created_at,
        'updated_at' => $this->updated_at,
        ],
      ];
    }
}
