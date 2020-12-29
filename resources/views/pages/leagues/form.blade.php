@extends('index')

@section('title', $id ? 'Edit ' . $league->name : 'Add League')

@section('content')
<main>
    <div class="container pt-5">
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