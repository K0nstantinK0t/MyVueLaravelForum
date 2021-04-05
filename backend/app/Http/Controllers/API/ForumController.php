<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Directory;
use Illuminate\Http\Request;

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

}
