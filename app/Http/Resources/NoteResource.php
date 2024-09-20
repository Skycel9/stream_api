<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Video;
use App\Http\Resources\VideoResource;

class NoteResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array
     */
    public function toArray(Request $request): array
    {
        $video = Video::find($this->video_id);

        return array(
            "note"=>$this->value,
            "video"=> new VideoResource($video)
        );
    }
}
