@extends('index')

@section('title', 'Home')

@section('content')
<main>
    <div class="container py-5">
        @guest
            <h4>Welcome to Football Dashboard!</h4>
            <p>
                You need to be 
                <a href="{{ route('site.login') }}"><u>logged in</u></a> 
                to view the teams and leagues!
            </p>
        @endguest
        @auth
            <h3 class="mb-3">Latest Leagues</h3>
            <div class="row mb-5">
                @foreach($leagues as $league)
                    <div class="col-md-3">
                        <a href="{{ route('site.leagues.inner', $league->slug) }}" class="card bg-dark text-white rounded p-4">
                            @if($league->logo)
                                <div class="image mb-3 d-block text-center" style="height: 100px">
                                    <img src="{{ $league->logo }}" class="img-fluid h-100">
                                </div>
                            @endif
                            <h5 class="w-100 text-center">{{ $league->name }}</h5>
                        </a>
                    </div>
                @endforeach
                @if(! $leagues->count())
                    <p class="col-12">No leagues found.</p>
                @endif
            </div>

            <h3 class="mb-3">Latest Teams</h3>
            <div class="row mb-5">
                @foreach($teams as $team)
                    <div class="col-md-3">
                        <div class="card bg-dark text-white rounded p-4">
                            @if($team->logo)
                                <div class="image mb-3 d-block text-center" style="height: 100px">
                                    <img src="{{ $team->logo }}" class="img-fluid h-100">
                                </div>
                            @endif
                            <h5 class="w-100 text-center">{{ $team->name }}</h5>
                        </div>
                    </div>
                @endforeach
                @if(! $teams->count())
                    <p class="col-12">No teams found.</p>
                @endif
            </div>
        @endauth
    </div>
</main>
@endsection