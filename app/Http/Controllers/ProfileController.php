<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Profile;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth', ['except' => 'show']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(Profile $profile)
    {
        $projects = Project::where('user_id', $profile->user_id)->paginate(6);

        return view('profiles.show', compact('profile', 'projects'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(Profile $profile)
    {
        $this->authorize('view', $profile);
        return view('profiles.edit', compact('profile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        $this->authorize('update', $profile);

        $data = request()->validate([
            'name' => 'required',
            'website' => 'required',
            'description' => 'required|min:10',
            'area' => 'required',
        ]);

        if ($request['image']) {
            $image_route = $request['image']->store('upload-profiles', 'public');

            $img = Image::make(storage_path("/storage/" . $image_route))->fit(600, 600);
            $img->save();

            $image_array = ['image' => $image_route];
        }


        auth()->user()->name = $data['name'];
        auth()->user()->website = $data['website'];
        auth()->user()->area = $data['area'];
        auth()->user()->save();

        unset($data['name']);
        unset($data['website']);
        unset($data['area']);

        auth()->user()->profile()->update(array_merge($data, $image_array ?? []));

        return redirect()->action([ProjectController::class, 'index']);
    }

    public function search(Request $request)
    {

        $search = $request['search'];

        $profiles = Profile::where('description', 'like', '%' . $search . '%')->paginate(10);


        return view('profiles.search', compact('profiles'));
    }
}
