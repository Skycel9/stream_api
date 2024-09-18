<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;
use App\Models\Category;
use App\Models\User;
use App\Models\Attachment;

class VideoCollection extends ResourceCollection
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
            "data"=> $this->collection->transform(function ($video) {
                $category = new CategoryResource(Category::Find($video->category_id));
                $author = new UserResource(User::Find($video->author_id));
                $attachments = new AttachmentResource(Attachment::Find($video->miniature));
                return [
                    "id"=> $video->id,
                    "title"=> $video->title,
                    "description"=> $video->description,
                    "miniature"=> $attachments ? [
                        "url"=> $attachments->url,
                        "alt"=> $attachments->alt
                    ] : null,
                    "category"=> $category ? new CategoryResource($category) : null,
                    "author"=> $author ? new UserResource($author) : null,
                    "created_at"=> $video->created_at ? $video->created_at->toDateTimeString() : null,
                    "updated_at"=> $video->updated_at ? $video->created_at->toDateTimeString() : null,
                ];
            }),
            "meta"=> [
                "total"=> $total
            ]
        );
    }
}
