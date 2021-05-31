@extends('layouts.app')

@section('hero')

    <div class="top-hero">
        <div class="hero-welcome">
            <form action="{{ route('profiles.search') }}" class="container h-100">
                <div class="row h-100 align-items-center">
                    <div class="col-md-4">
                        <p class="display-4 text-light">
                            Find a Dev for your next project!
                        </p>

                        <input type="search" name="search" id="search" class="form-control" placeholder="Search Dev">
                    </div>
                </div>
            </form>
        </div>

    </div>

@endsection

@section('content')

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css"
        integrity="sha512-tS3S5qG0BlhnQROyJXvNjeEM4UpMXHrQfTGmbQ1gKmelCxlSEBUaxhRBj/EFTzpbP4RVSrpEikbmdJobCvhE3g=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />


    <div class="container">
        <h2 class="text-center">Latest Devs added</h2>

        <div class="owl-carousel owl-theme">
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
        </div>

        <h2 class="text-center mt-4">Devs with more time here</h2>
        <div class="owl-carousel owl-theme">
            @foreach ($oldests as $profile)
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
        </div>

    </div>
@endsection
