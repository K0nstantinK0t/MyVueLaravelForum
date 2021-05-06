<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class DirectoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $directories = Directory::all()->with('posts', 'childDirectories');
        return response()->json(['directories' => $directories], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        // validation
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'max:64']
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // create model
        $newDirectory = Directory::findOrfail($request->parent_id ?? 1)->childDirectories()->create([
            'name' => $request->name
        ]);
        return response()->json(['directory' => $newDirectory], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  $directoryID
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($directoryID)
    {
        $directory = Directory::findOrFail($directoryID)->with('posts', 'childDirectories')->first();
        return response()->json(['directory' => $directory], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  $directoryID
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, $directoryID)
    {
        // will review in future for secure and improving
        $directory = Directory::findOrFail($directoryID);
        $directory->update($request->all());
        return response()->json(['directory' => $directory]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  $directoryID
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($directoryID)
    {
        // will review in future for secure and improving

        if($directoryID == 1)
            return response()->json(['message' => 'You can\'t delete a Root directory!'], 400);
        if(Directory::destroy($directoryID)) {
            return response()->json(['message' => 'Directory deleted successful'], 200);
        }
        else {
            return response()->json(['message' => 'So directory doesn\'t exists', 400]);
        }
    }
}
