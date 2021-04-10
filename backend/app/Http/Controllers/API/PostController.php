<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    // TODO: realize
    /**
     * Display a listing of the resource.
     *
     * @param $directoryID
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($directoryID)
    {
        $posts = Post::all();
        return response()->json(['posts' => $posts], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $directoryID
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $directoryID)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'header' => ['required', 'max:255']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // create model
        $header = $request->header;
        $post = $request->user()->posts()->create([
            'header' => $header,
            'directory_id' => $directoryID]);
        return response()->json(['post' => $post], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $postID
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($postID)
    {
        $post = Post::findOrFail($postID);
        return response()->json(['post' => $post], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $postID
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $postID)
    {
        $editingPost = Post::findOrFail($postID);
        if($request->user()->id != $editingPost->author_id)
            return response()->json(['message' => 'You try change post of other!'], 403);
        Post::find($postID)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param $postID
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $postID)
    {
        $deletingPost = Post::findOrFail($postID);
        if($request->user()->id != $deletingPost->author_id)
            return response()->json(['message' => 'You try delete post of other!'], 403);
    }
}
