@extends('index')

@section('title', $id ? 'Edit ' . $season->name : 'Add Season')

@section('content')
<main>
    <div class="container pt-5">
        <div class="row justify-content-center">
            <season-form
                :season='@JSON($season)'
                :id='@JSON($id)'
                save-url="{{ route('site.seasons.save') }}"
                :league-id='@JSON($league_id)'
                :league='@JSON($league)'
                :teams='@JSON($teams)'
            ></season-form>
        </div>
    </div>
</main>
@endsection