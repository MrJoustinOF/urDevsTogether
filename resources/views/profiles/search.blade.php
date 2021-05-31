@extends('layouts.app')

@section('content')

    <div class="container search">
        <h2 class="text-center">Results:</h2>
        @if (count($profiles) > 0)
            @foreach ($profiles as $profile)
                <div class="card my-4">
                    <img src="/storage/{{ $profile->image }}" class="card-img-top" alt="">

                    <div class="card-body">
                        <h3>{{ $profile->user->name }}</h3>
                        <h4><strong>{{ $profile->user->area }}</strong></h4>

                        <a href="{{ route('profiles.show', ['profile' => $profile->user_id]) }}"
                            class="btn btn-dark d-block">View
                            Profile</a>
                    </div>
                </div>
            @endforeach
        @else
            <h2 class="text-center">No devs found</h2>
        @endif
    </div>

    <div class="projects-links">
        {{-- Import Tailwind CDN for Links --}}
        <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
        {{ $profiles->links() }}

        {{-- Back to styles --}}
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    </div>

@endsection
