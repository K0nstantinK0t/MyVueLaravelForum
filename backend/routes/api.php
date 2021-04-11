<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ForumController; // TODO: delete
use \App\Http\Controllers\API\PostController;
use \App\Http\Controllers\API\DirectoryController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/token', [AuthController::class, 'token']);

Route::middleware('auth:sanctum')->group(function (){
    Route::get('/user/name', function (Request $request) {
        return response()->json(['name' => $request->user()->name]);
    });
    Route::get('/logout', [AuthController::class, 'logOut']);
    Route::get('/isvalidtoken', [AuthController::class, 'isValidToken']);
    Route::prefix('forum')->group(function (){
        // TODO: convert directory to resource
        Route::apiResource('directories',DirectoryController::class)->shallow();
        Route::apiResource('directories.posts',PostController::class)->shallow();
    });
});
