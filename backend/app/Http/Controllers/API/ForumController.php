<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ForumController extends Controller
{
    private const rootDirectoryID = 1;

    /*
     * Get directory content including inline directories
     * TODO: realize functional
     */
    public function getDirectory($directoryID = self::rootDirectoryID)
    {
        $posts = Directory::findOrFail($directoryID)->posts;
        return response()->json(['posts' => $posts], 200);
    }
//
//    public function addPost(Request $request, $directoryID = self::rootDirectoryID)
//    {
//        // validation
//        $validator = Validator::make($request->all(), [
//            'header' => ['required', 'max:255']
//        ]);
//
//        if ($validator->fails()) {
//            return response()->json(['errors' => $validator->errors()], 422);
//        }
//
//        // create model
//        $header = $request->header;
//        $post = $request->user()->posts()->create([
//            'header' => $header,
//            'directory_id' => $directoryID]);
//        return response()->json(['post' => $post]);
//    }

}
