<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Models\Video;
use App\Http\Resources\VideoResource;

class LikeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return \App\Http\Resources\VideoResource
     */
    public function toArray(Request $request): \App\Http\Resources\VideoResource
    {
        $video = Video::find($this->video_id);

        return new VideoResource($video);
    }
}
