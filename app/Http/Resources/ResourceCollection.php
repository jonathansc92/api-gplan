<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection as LaravelResourceCollection;

class ResourceCollection extends LaravelResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        return [
            'data' => $this->collection,
            'total' => $this->total(),
            'page' => $this->currentPage(),
            'last_page' => $this->lastPage(),
        ];
    }
}
