<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Attachment;
use App\Http\Resources\AttachmentResource;
use App\Models\Video;

class AttachmentController extends Controller
{
    public function show($id) {
        $attachment = Attachment::FindOrFail($id);
        return new AttachmentResource($attachment);
    }
}
