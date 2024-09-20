<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteResource;
use Illuminate\Http\Request;
use App\Models\Note;
use App\Models\Video;
use App\Http\Resources\NoteCollection;
use Illuminate\Support\Facades\Validator;

class NoteController extends Controller
{
    public function index(Request $request) {
        $videos = Note::where("user_id", "=", auth()->user()->id)->get();

        if ($videos->count() <= 0) {
            return response()->json([
                "status"=> false,
                "message"=> "You have note any videos"
            ], 400);
        }

        return  new NoteCollection($videos);
    }

    public function show(Request $request) {
        $video = Video::findOrFail($request->id);
        $rel = Note::where("user_id", "=", auth()->user()->id)->where("video_id", "=", $video->id)->first();

        if ($rel && $rel->count() >= 1) {
            return response()->json([
                "status"=> true,
                "message"=> "You have note this video",
                "data"=> new NoteResource($rel)
            ], 200);
        } else {
            return response()->json([
                "status"=> false,
                "message"=> "You haven't note this video"
            ], 400);
        }
    }

    public function update(Request $request) {
        $video = Video::findOrFail($request->id);
        $rel = Note::where("user_id", "=", auth()->user()->id)->where("video_id", "=", $video->id)->first();

        $valideNote = Validator::make($request->all(), [
            "note"=> "required"
        ]);

        if ($valideNote->fails()) {
            return response()->json([
                "status"=> false,
                "message"=> "Validation failed",
                "errors"=> $valideNote->errors()
            ], 401);
        }

        if (!$rel) {
            $note = Note::create([
                "user_id"=> auth()->user()->id,
                "video_id"=> $video->id,
                "value"=> $request->note
            ]);

            return response()->json([
                "status"=> true,
                "message"=> "Note added successfully",
                "data"=> $note
            ], 200);
        }
    }

    public function delete(Request $request) {
        $video = Video::findOrFail($request->id);
        $rel = Note::where("user_id", "=", auth()->user()->id)->where("video_id", "=", $video->id)->first();

        if (!$rel) {
            return response()->json([
                "status"=> false,
                "message"=> "You don't have this video's note"
            ], 400);
        }

        $rel->delete();

        return response()->json([
            "status"=> true,
            "message"=> "Note deleted successfully"
        ], 200);
    }
}
