<?php

namespace App\Http\Controllers;

use App\Http\Resources\NoteCollection;
use App\Http\Resources\VideoCollection;
use App\Http\Resources\VideoResource;
use App\Models\Category;
use App\Models\Note;
use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    public function index($id = null) {
        if ($id) {
            $video = Video::where('category_id', $id)->get();
            return new VideoCollection($video);
        }
        $video = Video::all();
        return new VideoCollection($video);
    }
    public function show($id) {
        $video = Video::findOrFail($id);

        return new VideoResource($video);
    }

    public function catFilter(Request $request, int|string $id) {
        if (intval($id) <= 0) {
            $cat = Category::where('slug',"=",  $id)->get()->first()->id;
        } else {
            $cat = $id;
        }
        $videos = Video::where('category_id', "=", $cat)->get();

        return new VideoCollection($videos);
    }

    public function notesFilterAbove(Request $request, float $value) {
        $note = Note::where("value", ">=", $value)->get();
        return new NoteCollection($note);
    }
    public function notesFilterBelow(Request $request, float $value) {
        $note = Note::where("value", "<=", $value)->get();
        return new NoteCollection($note);
    }
}
