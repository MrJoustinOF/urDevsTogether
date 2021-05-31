@extends('layouts.app')

@section('buttons')

    <a class="btn btn-outline-dark mx-1 mb-2" href="{{ route('projects.create') }}">

        <svg xmlns="http://www.w3.org/2000/svg" class="icon mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6" />
        </svg>

        Add</a>
    <a class="btn btn-outline-primary mx-1 mb-2" href="{{ route('profiles.edit', ['profile' => Auth::user()->id]) }}">

        <svg xmlns="http://www.w3.org/2000/svg" class="icon mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
        </svg>

        Edit
        Profile</a>
    <a class="btn btn-outline-success mx-1 mb-2" href="{{ route('profiles.show', ['profile' => Auth::user()->id]) }}">

        <svg xmlns="http://www.w3.org/2000/svg" class="icon mx-auto" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z" />
        </svg>

        My
        Profile</a>

@endsection
@section('content')
    <h2 class="text-center">Your Projects</h2>
    <div class="col-md-10 mx-auto p-3">

        @if (count($projects) > 0)
            @foreach ($projects as $project)
                <div class="section-cards">
                    <div class="card mt-2 text-center">
                        <h5 class="card-header bg-dark text-white text-center">{{ $project->title }}</h5>
                        <div class="card-body">
                            <p class="card-text">{{ $project->description }}</p>

                            <div>
                                <delete-project project-id={{ $project->id }}></delete-project>

                                <a href="{{ route('projects.edit', ['project' => $project->id]) }}"
                                    class="btn btn-primary mt-1">Update</a>

                                <a href="{{ route('projects.show', ['project' => $project->id]) }}"
                                    class="btn btn-success mt-1">View</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <h2 class="text-center my-5">No projects yet</h2>
        @endif

        <div class="projects-links">

            {{-- Import Tailwind CDN for Links --}}
            <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
            {{ $projects->links() }}

            {{-- Back to styles --}}
            <link href="{{ asset('css/app.css') }}" rel="stylesheet">
        </div>
    </div>
@endsection
