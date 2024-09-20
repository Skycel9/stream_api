<?php

use App\Http\Controllers\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VideoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttachmentController;
use App\Http\Controllers\LikeController;
use App\Http\Controllers\NoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::apiResource("videos", VideoController::class);
Route::apiResource("categories", CategoryController::class);
Route::get("/categories/{slug}", [CategoryController::class, "show"]);
Route::get("/attachments/{id}", [AttachmentController::class, "show"]);

Route::get("categories/{id}/videos", [VideoController::class, "catFilter"]);
Route::get("notes/above/{value}/videos", [VideoController::class, "notesFilterAbove"]);
Route::get("notes/below/{value}/videos", [VideoController::class, "notesFilterBelow"]);

Route::post("register", [AuthController::class, "register"]);
Route::post("login", [AuthController::class, "login"]);

Route::middleware("auth:sanctum")->post("logout", [AuthController::class, "logout"]);
Route::middleware("auth:sanctum")->post("me", [AuthController::class, "me"]);

Route::middleware("auth:sanctum")->post("me/likes", [LikeController::class, "index"]);
Route::middleware("auth:sanctum")->post("videos/{id}/like", [LikeController::class, "update"]);

Route::middleware("auth:sanctum")->post("me/notes", [NoteController::class, "index"]);
Route::middleware("auth:sanctum")->post("videos/{id}/note", [NoteController::class, "show"]);
Route::middleware("auth:sanctum")->put("videos/{id}/note", [NoteController::class, "update"]);
Route::middleware("auth:sanctum")->delete("videos/{id}/note", [NoteController::class, "delete"]);
