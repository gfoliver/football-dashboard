@extends('index')

@section('title', $id ? 'Edit ' . $league->name : 'Add League')

@section('content')
<main>
    <div class="container pt-5">
        
        <a href="{{ isset($league) ? route('site.leagues.inner', $league->slug) : route('site.leagues') }}" class="text-secondary mb-3 d-block">
            <i class="fas fa-chevron-left"></i>
            Back
        </a>
        
        <div class="row justify-content-center">
            <league-form
                :league='@JSON($league)'
                :id='@JSON($id)'
                save-url="{{ route('site.leagues.save') }}"
            ></league-form>
        </div>
    </div>
</main>
@endsection