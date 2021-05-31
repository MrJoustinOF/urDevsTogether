<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    public function index()
    {
        // $projects = Auth::user()->projects;

        $user = Auth::user()->id;

        $projects = Project::where('user_id', $user)->paginate(5);

        return view('projects.index')->with('projects', $projects);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('projects.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = request()->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'url' => 'required',
            'image' => 'required|image'
        ]);

        $image_route = $request['image']->store('upload-projects', 'public');

        $img = Image::make(public_path("storage/{$image_route}"))->fit(1000, 550);
        $img->save();

        auth()->user()->projects()->create([
            'title' => $data['title'],
            'description' => $data['description'],
            'url' => $data['url'],
            'image' => $image_route,
        ]);


        return redirect()->action([ProjectController::class, 'index']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $this->authorize('view', $project);
        return view('projects.edit')->with('project', $project);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $data = request()->validate([
            'title' => 'required|min:5',
            'description' => 'required|min:10',
            'url' => 'required',
        ]);

        $project->title = $data['title'];
        $project->description = $data['description'];
        $project->url = $data['url'];

        if (request('image')) {
            $image_route = $request['image']->store('upload-projects', 'public');

            $img = Image::make(public_path("storage/{$image_route}"))->fit(1000, 550);
            $img->save();

            $project->image = $image_route;
        }

        $project->save();

        return redirect()->action([ProjectController::class, 'index']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('delete', $project);

        $project->delete();

        return redirect()->action([ProjectController::class, 'index']);
    }
}
