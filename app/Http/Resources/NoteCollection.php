<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class NoteCollection extends ResourceCollection
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
            "data"=> $this->collection->transform(function ($note) {
                return new NoteResource($note);
            }),
            "total"=> $total
        );
    }
}
