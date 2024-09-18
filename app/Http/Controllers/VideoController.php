<?php

namespace App\Http\Controllers;

use App\Http\Resources\VideoCollection;
use App\Http\Resources\VideoResource;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index($id = null) {
        if (!$id) {
            $video = Video::all();
            return new VideoCollection($video);
        }

        if (intval($id) > 0) {
            $video = Video::findOrFail($id);

            return new VideoResource($video);
        }
        return false;
    }
    public function show($id) {
        $video = Video::findOrFail($id);

        return new VideoResource($video);
    }
}
