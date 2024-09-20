<?php

namespace App\Http\Controllers;

use App\Http\Resources\CategoryResource;
use App\Http\Resources\CategoryCollection;
use App\Http\Resources\VideoCollection;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index() {
        $video = Category::all();

        return new CategoryCollection($video);
    }
    public function show($id) {
        if (intval($id) > 0) {
            $video = Category::findOrFail($id);
            return new CategoryResource($video);
        } else {
            $video = Category::where("slug", "=", $id);
            $video = $video->get()->first();
            return new CategoryResource($video);
        }
    }

}
