<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class CategoryCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        $total = $this->collection->count();
        return array(
            "data"=> $this->collection->transform(function ($cat) {
                return [
                    "id"=> $cat->id,
                    "name"=> $cat->name,
                    "slug"=> $cat->slug,
                    "description"=> $cat->description,
                    "color"=> $cat->color,
                    "created_at"=> $cat->created_at ? $cat->created_at->toDateTimeString() : null,
                    "updated_at"=> $cat->updated_at ? $cat->created_at->toDateTimeString() : null
                ];
            }),
            "meta"=> [
                "total"=> $total
            ]
        );
    }
}
