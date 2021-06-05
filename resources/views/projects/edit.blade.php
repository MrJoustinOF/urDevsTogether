@extends('layouts.app')

@section('buttons')

    <a class="btn btn-outline-dark" href="{{ route('projects.index') }}">Back</a>

@endsection

@section('content')
    <h2 class="text-center">Edit Project: {{ $project->title }}</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('projects.update', ['project' => $project->id]) }}" method="post" class="mx-2"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Your Project's Title" value="{{ $project->title }}">

                    @error('title')

                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>

                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Your Project's Description" cols="30"
                        rows="10">{{ $project->description }}</textarea>

                    @error('description')

                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>

                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" class="form-control @error('url') is-invalid @enderror"
                        placeholder="Your Project's URL" value="{{ $project->url }}">

                    @error('url')

                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>

                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-dark" value="Edit">
                </div>
            </form>
        </div>
    </div>

@endsection
