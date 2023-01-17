<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Project;
use App\Models\Type;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $projects = Project::all();
        return view('admin.projects.index', compact('projects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $types = Type::all();
        return view('admin.projects.create', compact('types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreProjectRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProjectRequest $request)
    {
        $form_data = $request->validated();
        $form_data['slug'] = Project::generateSlug($form_data['title']);
        if ($request->hasFile('cover_image')) {
            $path = Storage::put('project_images', $request->cover_image);
            $form_data['cover_image'] = $path;
        }
        $project = Project::create($form_data);
        return redirect()->route('admin.projects.index')->with('message', 'Il progetto è stato creato con successo');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $types = Type::all();
        return view('admin.projects.edit', compact('project', 'types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateProjectRequest  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {
        $form_data = $request->all();
        $form_data['slug'] = Project::generateSlug($form_data['title']);
        if ($request->hasFile('cover_image')) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $path = Storage::put('project_images', $request->cover_image);
            $form_data['cover_image'] = $path;
        }
        $project->update($form_data);
        return redirect()->route('admin.projects.index')->with('message', $project->title . ' è stato aggiornato con successo');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', $project->title . ' è stato cancellato');
    }
}
