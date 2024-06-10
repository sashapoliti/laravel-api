<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Models\Project;
use App\Models\Type;
use App\Models\Technology;

use Illuminate\Http\Request;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;

use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::paginate(7);
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.create', compact('types', 'technologies'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();        
        $form_data['slug'] = Project::generateSlug($form_data['title']);
        if ($request->hasFile('image')) {
            $form_data['image'] = Storage::putFileAs('project_images', $request->image, $request->image->getClientOriginalName());
        }
        $newProject = Project::create($form_data);
        if ($request->has('technologies')) {
            $newProject->technologies()->attach($request->technologies);
        }
        return redirect()->route('admin.projects.index')->with('success', 'Project created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        $technologies = Technology::all();
        return view('admin.projects.edit', compact('project', 'types', 'technologies'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->all();
        if ($project->title !== $form_data['title']) {
            $form_data['slug'] = Project::generateSlug($form_data['title']);
        }
        if ($request->hasFile('image')) {
            if ($project->image) Storage::delete($project->image); /* if there is an image, delete it */
            $form_data['image'] = Storage::putFileAs('project_images', $request->image, $request->image->getClientOriginalName());
        }
        $project->update($form_data);
        if ($request->has('technologies')) {
            $project->technologies()->sync($request->technologies);
        } else {
            $project->technologies()->sync([]);
        }
        return redirect()->route('admin.projects.index')->with('success', 'Project updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->image) Storage::delete($project->image); /* if there is an image, delete it */
        $project->delete();
        return redirect()->route('admin.projects.index')->with('success', 'Project deleted successfully');
    }
}
