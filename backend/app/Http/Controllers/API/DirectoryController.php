<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Directory;
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
        $directories = Directory::all()->loadMissing('posts', 'childDirectories');
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
     * @param  int  $directoryID
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($directoryID)
    {
        $directory = Directory::findOrFail($directoryID)->loadMissing('posts', 'childDirectories');
        return response()->json(['directory' => $directory], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $directoryID
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $directoryID)
    {
        // will review in future for secure and improving
        Directory::findOrFail($directoryID)->update($request->all());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $directoryID
     * @return \Illuminate\Http\Response
     */
    public function destroy($directoryID)
    {
        // will review in future for secure and improving
        Directory::destroy($directoryID);
    }
}
