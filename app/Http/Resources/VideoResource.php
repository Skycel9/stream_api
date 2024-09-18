<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Category;
use App\Models\User;
use App\Models\Attachment;

class VideoResource extends JsonResource {
    public function toArray(Request $request): array {
        $category = new CategoryResource(Category::Find($this->category_id));
        $author = new UserResource(User::Find($this->author_id));
        $attachments = new AttachmentResource(Attachment::Find($this->miniature));
        return [
            "id"=> $this->id,
            "title"=> $this->title,
            "description"=> $this->description,
            "miniature"=> $attachments ? [
                "url"=> $attachments->url,
                "alt"=> $attachments->alt
            ] : null,
            "category"=> $category ? new CategoryResource($category) : null,
            "author"=> $author ? new UserResource($author) : null,
            "created_at"=> $this->created_at ? $this->created_at->toDateTimeString() : null,
            "updated_at"=> $this->updated_at ? $this->created_at->toDateTimeString() : null,
        ];
    }
}
