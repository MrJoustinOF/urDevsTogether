@extends('layouts.app')

@section('buttons')

    <a class="btn btn-outline-dark" href="{{ route('projects.index') }}">Back</a>

@endsection

@section('content')

    <h2 class="text-center">Add New Project</h2>

    <div class="row justify-content-center mt-5">
        <div class="col-md-8">
            <form action="{{ route('projects.store') }}" method="post" class="mx-2" enctype="multipart/form-data"
                novalidate>
                @csrf

                <div class="form-group">
                    <label for="title">Title</label>
                    <input type="text" name="title" id="title" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Your Project's Title" value="{{ old('title') }}">

                    @error('title')

                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>

                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Your Project's Description" cols="30" rows="10">{{ old('description') }}</textarea>

                    @error('description')

                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>

                    @enderror
                </div>

                <div class="form-group">
                    <label for="url">URL</label>
                    <input type="text" name="url" id="url" class="form-control @error('title') is-invalid @enderror"
                        placeholder="Your Project's URL" value="{{ old('url') }}">

                    @error('url')

                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>

                    @enderror
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-dark" value="Add">
                </div>
            </form>
        </div>
    </div>

@endsection
