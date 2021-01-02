@extends('index')

@section('title', $league->name)

@section('content')
<main class="league-page">
    <div class="hero" style="background-image: url({{ $league->cover }})">
        <div class="container">
            @if($league->logo)
                <div class="logo-wrapper rounded">
                    <img src="{{ $league->logo }}" class="logo">
                </div>
            @endif
        </div>
        <div class="container">
            <div class="bg-dark rounded pt-3 px-3">
                <div class="row">
                    <div class="col-md-8">
                        <h2 class="mb-3">{{ $league->name }}</h2>
                    </div>
                    <div class="col-md-2">
                        @if(isset($season))
                            <a href="{{ route('site.leagues.seasons.match.form', ['slug' => $league->slug, 'id' => $season->id]) }}" class="btn btn-success w-100">
                                <i class="fas fa-futbol"></i> Save Match
                            </a>
                        @endif
                    </div>
                    <div class="col">
                        <a href="{{ route('site.leagues.form', $league->id) }}" class="btn btn-primary w-100">
                            <i class="fas fa-edit"></i> Edit
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container py-5">
        @if($standings)
            <div class="row align-items-center">
                <div class="col-md-10">
                    <h4>{{ $season->name }} Season Table</h4>
                </div>
                <div class="col">
                    <a href="{{ route('site.leagues.seasons', $league->slug) }}" class="d-block float-right">
                        <small>View other seasons</small>
                    </a>
                </div>
            </div>
            <table class="table table-dark table-bordered table-striped mt-3">
                <thead>
                    <tr>
                        <th>Position</th>
                        <th>Team</th>
                        <th>Points</th>
                        <th title="Matches"><u>M</u></th>
                        <th title="Won"><u>W</u></th>
                        <th title="Drawn"><u>D</u></th>
                        <th title="Lost"><u>L</u></th>
                        <th title="Goal difference"><u>GD</u></th>
                        <th title="Goals for"><u>GF</u></th>
                        <th title="Goals against"><u>GA</u></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($standings as $index => $team)
                        <tr>
                            <td class="align-middle">{{ $index + 1 }}</td>
                            <td class="align-middle">
                                <div class="d-flex align-items-center">
                                    @if($team->team->logo)
                                        <img src="{{ $team->team->logo }}" style="width: 30px; height: 30px; object-fit: contain; margin-right: 20px">
                                    @endif
                                    <div class="name" style="font-size: 20px">{{ $team->team->name }}</div>
                                </div>
                            </td>
                            <td class="align-middle">{{ $team->points }}</td>
                            <td class="align-middle">{{ $team->matches }}</td>
                            <td class="align-middle">{{ $team->wins }}</td>
                            <td class="align-middle">{{ $team->draws }}</td>
                            <td class="align-middle">{{ $team->losses }}</td>
                            <td class="align-middle">{{ $team->goal_difference }}</td>
                            <td class="align-middle">{{ $team->goals_scored }}</td>
                            <td class="align-middle">{{ $team->goals_conceded }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <h6>No seasons found</h6>
            <a href="{{ route('site.leagues.seasons.form', $league->slug) }}" class="btn btn-primary">Add Season</a>
        @endif
    </div>
</main>
@endsection