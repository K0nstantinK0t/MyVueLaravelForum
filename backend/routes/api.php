<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ForumController;
use \App\Http\Controllers\API\PostController;

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
        Route::get('/{directoryID?}', [ForumController::class, 'getDirectory'])
            ->where('directoryID', '[0-9]*'); // RegEx - only number can be passed or nothing
        Route::resource('directories.posts', PostController::class);

    });
});
