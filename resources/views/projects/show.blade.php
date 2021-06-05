@extends('layouts.app')

@section('content')

    <article class="">

        <h2 class="text-center mb-4">{{ $project->title }}</h2>

        <div class="project-image">
            {{-- <img src="/storage/{{ $project->image }}" alt="" class="mx-auto d-block img-responsive"> --}}
        </div>

        <div class="project-meta text-center mt-4">

            <h2 class="font-weight-bold">Made by:<p>
                    {{ $project->author->name }}
                </p>
            </h2>

            <h2 class="font-weight-bold">Description:</h2>
            <p class="mx-5">
                {{ $project->description }}
            </p>

            <h2>URL:</h2>
            <p>
                {{ $project->url }}
            </p>

            <a href="{{ $project->url }}" target="BLANK" class="btn btn-dark">Visit website</a>
        </div>

    </article>


@endsection
