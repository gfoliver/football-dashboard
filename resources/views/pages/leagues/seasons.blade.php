@extends('index')

@section('title', $league->name . ' seasons')

@section('content')
<main>
    <div class="container pt-5">
        <a href="{{ route('site.leagues.inner', $league->slug) }}" class="text-secondary mb-3 d-block">
            <i class="fas fa-chevron-left"></i>
            Back
        </a>
        <div class="row">
            <div class="col-md-10">
                <h2 class="mb-4">{{ $league->name }} seasons</h2>
            </div>
            <div class="col">
                <a href="{{ route('site.leagues.seasons.form', $league->slug) }}" class="btn btn-primary w-100 mb-5">Add Season</a>
            </div>
        </div>
        <seasons-table
            :seasons='@JSON($seasons)'
            form-route="{{ route('site.leagues.seasons.form', $league->slug) }}"
            inner-route="{{ route('site.leagues.seasons.inner', ['slug' => $league->slug, 'id' => '/']) }}"
            delete-url="{{ route('site.seasons.delete', '') }}"
        ></seasons-table>
    </div>
</main>
@endsection