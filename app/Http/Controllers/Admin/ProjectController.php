<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use Illuminate\Support\Str;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Technology;
use Illuminate\Support\Facades\Storage;
use App\Models\Type;


class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $value = $request->numberPage? $request->numberPage : 10;
        $projectsList = Project::withCount('technologies')
                                 ->paginate($value)
                                 ->appends(['numberPage' => $value]);
        return view('admin.projects.index', compact('projectsList'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $typeList = Type::All();
        $technologyList = Technology::All();
        return view('admin.projects.create', compact('typeList','technologyList'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProjectRequest $request)
    {
        $data = $request->validated();
        $newItem = new Project();
        $newItem->fill($data);
        if (isset($data['cover_image'])) {
            $newItem->cover_image = Storage::put('img', $data['cover_image']);
        }
        $newItem->slug = Str::slug($newItem->title);
        $newItem->save();

        if($request->has('technologies')){
            // dd($request->all());
            $newItem->technologies()->attach($request->technologies);
        }
        return redirect()->route("admin.projects.index");
    }

    /**
     * Display the specified resource.
     */

    // the method is passed an object as a parameter
    // in this case this method handles the exception by sending us to page 404 automatically
    public function show(Project $project)
    {
        return view("admin.projects.show", compact("project"));
    }

    public function edit(Project $project)
    {
        $typeList = Type::All();
        return view('admin.projects.edit', compact('project','typeList'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateProjectRequest $request, Project $project)
    {

        $data = $request->validated();
        if (isset($data['cover_image'])) {
            if ($project->cover_image) {
                Storage::delete($project->cover_image);
            }
            $data['cover_image'] = Storage::put('img', $data['cover_image']);
        }
        // remove image without add other
        if($request['removeImage'] != NULL && $project->cover_image != NULL){
            Storage::delete($project->cover_image);
            $project->cover_image = NULL;
        }
        // /remove image without add other

        $data['slug'] = Str::slug($data['title']);
        $project->update($data);
        return view('admin.projects.show', compact('project'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Project $project)
    {
        if ($project->cover_image) {
            Storage::delete($project->cover_image);
        }
        $project->delete();
        return redirect()->route('admin.projects.index')->with('message', 'il progetto ' .  $project->title . ' è stato cancellato');
    }

    // show the trashed projects
    public function trash()
    {
        $trashList = Project::onlyTrashed()->get();
        return view('admin.projects.trash', compact('trashList'));
    }

    // permanently delete a record
    public function forceDelete($id){
        $project = Project::onlyTrashed()->where('id', $id)->firstOrFail();
        Project::onlyTrashed()->find($id)->forceDelete();
        return redirect()->route('admin.projects.trash')->with('message' , 'il progetto '. $project->title .' è stato cancellato definitivamente');
    }

    // restore a record
    public function restore($id){
        $project = Project::onlyTrashed()->where('id', $id)->firstOrFail();
        Project::onlyTrashed()->find($id)->restore();
        return redirect()->route('admin.projects.trash')->with('message' , 'il progetto '. $project->title .' è stato ripristinato');
    }

    // restore all record
    public function restoreAll(){
        Project::onlyTrashed()->restore();
        return redirect()->route('admin.projects.trash')->with('message' , 'sono sati ripristinati tutti i progetti');
    }
}
