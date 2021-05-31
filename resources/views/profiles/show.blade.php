@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-5">
                @if ($profile->image)
                    <img src="/storage/{{ $profile->image }}" alt="profile image" class="w-100 rounded-circle">
                @endif
            </div>
            <div class="col-md-7 mt-5 mt-md-0">
                <h2 class="text-center mb-2">{{ $profile->user->name }}</h2>
                <h3>Area: {{ $profile->user->area }}</h2>
                    <div class="description">
                        <h3>Description:</h3>
                        {{ $profile->description }}
                    </div>

            </div>
        </div>
    </div>

    <h2 class="text-center my-5">Projects made by: {{ $profile->user->name }}</h2>

    <div class="container">
        <div class="row mx-auto bg-white p-4">
            @if (count($projects) > 0)
                @foreach ($projects as $project)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            <img src="/storage/{{ $project->image }}" class="card-img-top" alt="project image">

                            <div class="card-body">
                                <h3>{{ $project->title }}</h3>

                                <a href="{{ route('projects.show', ['project' => $project->id]) }}"
                                    class="btn btn-dark d-block mt-4 text-uppercase font-weight-bold">View
                                    project</a>
                            </div>
                        </div>
                    </div>
                @endforeach

                <div class="projects-links my-4 d-block w-100">

                    {{-- Import Tailwind CDN for Links --}}
                    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
                    {{ $projects->links() }}

                    {{-- Back to styles --}}
                    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
                </div>
            @else
                <h2 class="text-center my-5">
                    No projects yet.
                </h2>
            @endif
        </div>
    </div>

@endsection
