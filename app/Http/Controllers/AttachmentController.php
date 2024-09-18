<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Http\Resources\AttachmentResource;
use App\Models\Video;

class AttachmentController extends Controller
{
    public function show($id) {
        $attachment = Attachment::findOrFail($id);
        return new AttachmentResource($attachment);
    }

    public function join($id) {
        $video = Video::FindOrFail($id);

        $miniature = $video->miniature;
        $miniature = Attachment::FindOrFail($miniature);

        return new AttachmentResource($miniature);
    }
}
