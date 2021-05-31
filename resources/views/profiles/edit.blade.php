@extends('layouts.app')

@section('buttons')

    <a class="btn btn-outline-dark" href="{{ route('projects.index') }}">Back</a>

@endsection

@section('content')

    <h2 class="text-center">Edit Your Profile</h2>

    <div class="row justify-content-center mt-5 mx-2">
        <div class="col-md-8 bg-white">
            <form action="{{ route('profiles.update', ['profile' => $profile->id]) }}" method="POST"
                enctype="multipart/form-data" novalidate>
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                        placeholder="Your Name" value="{{ $profile->user->name }}">

                    @error('title')

                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>

                    @enderror
                </div>

                <div class="form-group">
                    <label for="description">Description</label><br>
                    <strong><span>Be sure to add your name in yor description, to be on the searchs!</span></strong>
                    <textarea name="description" id="description"
                        class="form-control @error('description') is-invalid @enderror"
                        placeholder="Your Description, be sure to add your name, to be on the searchs!" cols="30"
                        rows="10">{{ $profile->description }}</textarea>

                    @error('description')

                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>

                    @enderror
                </div>

                <div class="form-group row">
                    <label for="area" class="col-md-1 col-form-label text-md-right">Area</label>

                    <div class="col-md-4">

                        <select name="area" id="area" class="form-control @error('area') is-invalid @enderror">
                            <option value="none" selected disabled hidden>Choose one:</option>
                            <option value="Dev-Web">Dev Web</option>
                            <option value="Mobile-Dev">Mobile Dev</option>
                            <option value="Game-Dev">Game Dev</option>
                            <option value="Machine-Learning">Machine Learning</option>
                        </select>

                        @error('area')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </div>

                <div class="form-group">
                    <label for="image">Choose an image</label>
                    <input type="file" name="image" id="image" class="form-control @error('image') is-invalid @enderror">
                    @error('image')

                        <span class="invalid-feedback d-block" role="alert">
                            {{ $message }}
                        </span>

                    @enderror

                    <div class="mt-4">
                        <p>Current image:</p>
                        <img src="/storage/{{ $profile->image }}" alt="" style="width: 250px">
                    </div>
                </div>

                <div class="form-group">
                    <input type="submit" class="btn btn-dark" value="Update Profile">
                </div>
            </form>
        </div>
    </div>

@endsection
