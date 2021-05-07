<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\PostController;
use App\Http\Controllers\API\DirectoryController;
use App\Http\Controllers\API\MessageController;

Route::post('/register', [AuthController::class, 'register']);
Route::post('/token', [AuthController::class, 'token']);

Route::middleware('auth:sanctum')->group(function (){
    Route::prefix('user')->group(function(){
        Route::get('/', function (Request $request) {
            return response()->json(['user' => [
                'name' => $request->user()->name,
                'id' => $request->user()->id]
                ], 200);
        });
    });
    Route::get('/logout', [AuthController::class, 'logOut']);
    Route::get('/isvalidtoken', [AuthController::class, 'isValidToken']);
    Route::prefix('forum')->group(function (){
        Route::apiResource('directories',DirectoryController::class)->shallow();
        Route::apiResource('directories.posts',PostController::class)->shallow();
        Route::apiResource('posts.messages',MessageController::class)->shallow();
    });
});
