<?php

namespace App\Http\Controllers\Api;

use App\Models\Project;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $type = $request->query('type');
        $projects = Project::with('technologies', 'type')->when($type, function (Builder $query, string $type) {
            return $query->where('type_id', $type);
        })->paginate(4);
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
