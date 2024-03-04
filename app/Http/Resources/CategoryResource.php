<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request)
    {
        $categories = $this->resource->items();

        return [
           'status' => 200,
           'data' => array_map(function ($category) {
               return [
                   'id' => $category->id,
                   'name' => $category->name,
                   'image' => $category->image,
                   'created_at' => $category->created_at,
                   'updated_at' => $category->updated_at,
               ];
           }, $categories),
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
