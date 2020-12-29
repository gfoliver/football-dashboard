@extends('index')

@section('title', $id ? 'Edit ' . $team->name : 'Add Team')

@section('content')
<main>
    <div class="container pt-5">
        <div class="row justify-content-center">
            <team-form
                :team='@JSON($team)'
                :id='@JSON($id)'
                save-url="{{ route('site.teams.save') }}"
            ></team-form>
        </div>
    </div>
</main>
@endsection