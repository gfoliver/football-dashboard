@extends('index')

@section('title', 'Save Match')

@section('content')
<main>
    <div class="container pt-5">
        <a href="{{ route('site.leagues.inner', $slug) }}" class="text-secondary mb-3 d-block">
            <i class="fas fa-chevron-left"></i>
            Back
        </a>
        <div class="row justify-content-center">
            <match-form
                save-url="{{ route('site.leagues.seasons.match.save', ['slug' => $slug, 'id' => $id]) }}"
                :teams='@JSON($teams)'
                :season-id="{{ $id }}"
            ></match-form>
        </div>
    </div>
</main>
@endsection