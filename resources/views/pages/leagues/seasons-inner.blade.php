@extends('index')

@section('title', $season->name)

@section('content')
<main>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-8">
                <h2 class="mb-4">{{ $season->name }}</h2>
            </div>
            <div class="col-md-2">
                <a href="{{ route('site.leagues.seasons.match.form', ['slug' => $league->slug, 'id' => $season->id]) }}" class="btn btn-success w-100">
                    <i class="fas fa-futbol"></i> Save Match
                </a>
            </div>
            <div class="col">
                <a 
                    href="{{ route('site.leagues.seasons.form', ['slug' => $league->slug, 'id' => $season->id]) }}" 
                    class="btn btn-primary w-100 mb-5"
                >
                    <i class="fas fa-edit"></i> Edit
                </a>
            </div>
        </div>
        @if($standings)
            <div class="row align-items-center">
                <div class="col-md-10">
                    <h4>Table</h4>
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
        @endif
    </div>
</main>
@endsection