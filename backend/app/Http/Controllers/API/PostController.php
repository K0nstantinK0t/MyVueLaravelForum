<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $directoryID
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($directoryID)
    {
        $posts = Directory::find($directoryID)->posts;
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
            'header' => ['required', 'max:64'],
            'content' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // check existing of directory
        Directory::findOrfail($directoryID);

        // create init message and post
        $message = Message::create([
            'content' => $request->input('content'),
            'author_id' => $request->user()->id,
        ]);

        $post = $message->tiedPost()->create([
            'header' => $request->header,
            'author_id' => $request->user()->id,
            'directory_id' => $directoryID
        ]);

        $message->update(['post_id' => $post->id]);
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
            return response()->json(['message' => 'You try change another\'s  post!'], 403);
        $editingPost->update($request->all());
        return response()->json(['message' => 'Post was updated successful'], 200);
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
        if($request->user()->id != $deletingPost->author_id) {
            return response()->json(['message' => 'You try delete another\'s post!'], 403);
        }
        $deletingPost->delete();
        return response()->json(['message' => 'Post was deleted successful'], 200);
    }
}
