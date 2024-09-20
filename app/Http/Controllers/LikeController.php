<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\Like;
use Illuminate\Http\Request;
use App\Http\Resources\LikeCollection;

class LikeController extends Controller
{
    public function index(Request $request) {
        $videos = Like::where("user_id", "=", auth()->user()->id)->get();

        if ($videos->count() <= 0) {
            return response()->json([
                "status"=> false,
                "message"=> "No videos liked"
            ], 400);
        }

        return response()->json([
            "status"=> true,
            "message"=> "You liked these videos",
            "data"=> new LikeCollection($videos)
        ], 200);
    }

    public function update(Request $request) {
        $video = Video::findOrFail($request->id);
        $rel = Like::where("video_id", "=", $video->id)->where("user_id", "=", auth()->user()->id)->first();

        if (!$rel) {
            $like = Like::create([
                "user_id"=> auth()->user()->id,
                "video_id"=> $video->id,
            ]);

            return response()->json([
                "status"=> true,
                "message"=> "You liked this video",
                "data"=> $like
            ], 200);
        } else {
            $rel->delete();

            return response()->json([
                "status"=> true,
                "message"=> "You unliked this video",
            ], 200);
        }
    }
}
