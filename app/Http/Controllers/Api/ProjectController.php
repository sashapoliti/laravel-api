<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();
        return response()->json([
            'status' => 'success',
            'message' => 'Projects retrieved successfully',
            'results' => $projects
        ], 200);
    }

    public function show($slug)
    {
        $project = Project::where('slug', $slug)->with('technologies', 'type')->first();
        if (!$project) {
            return response()->json([
                'success' => 'error',
                'message' => 'Project not found'
            ], 404);
        } else {
            return response()->json([
                'status' => 'success',
                'message' => 'Project retrieved successfully',
                'results' => $project
            ], 200);
        }

    }
}
