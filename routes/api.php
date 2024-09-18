<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\VideoController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttachmentController;

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
Route::get("/categories/{id}/videos", [VideoController::class, "join"]);
Route::get("/attachments/{id}", [AttachmentController::class, "show"]);

Route::get("videos/{id}/attachments", [AttachmentController::class, "join"]);
Route::apiResource("categories/{id}/videos", VideoController::class);
