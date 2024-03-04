<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
  {
     $users = $this->resource->items();

     return [
        'status' => 200,
        'data' => array_map(function ($user) {
            return [
                'id' => $user->id,
                'name' => $user->name,
                'email' => $user->email,
                'type_id' => $user->type->name,
                'created_at' => $user->created_at,
                'updated_at' => $user->updated_at,
            ];
        }, $users),
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
