<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $postID
     * @return \Illuminate\Http\JsonResponse
     */
    public function index($postID)
    {
        $messages = Post::findOrFail($postID)->messages;
        return response()->json(['messages' => $messages], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $postID
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request, $postID)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'content' => ['required']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // create model
        $post = Post::findOrfail($postID)->messages()->create([
            'content' => $request->input('content'),
            'author_id' => $request->user()->id
        ]);
        return response()->json(['message' => $post], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param $messageID
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($messageID)
    {
        $message = Message::findOrFail($messageID);
        return response()->json(['message' => $message], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param $messageID
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $messageID)
    {
        $editingMessage = Message::findOrFail($messageID);
        if($request->user()->id != $editingMessage->author_id)
            return response()->json(['message' => 'You try change another\'s post!'], 403);
        $editingMessage->update($request->all());
        return response()->json(['message' => 'Message was updated successful'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Request $request
     * @param  $messageID
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Request $request, $messageID)
    {
        $deletingMessage = Message::findOrFail($messageID);
        if($request->user()->id != $deletingMessage->author_id) {
            return response()->json(['message' => 'You try delete another\'s message!'], 403);
        }
        $deletingMessage->delete();
        return response()->json(['message' => 'Message was deleted successful'], 200);
    }
}
