@extends('index')

@section('content')
<main>
    <div class="container pt-5">
        <div class="row justify-content-center">
            <team-form
                :team='@JSON($team)'
                :id='@JSON($id)'
                save-url="{{ route('api.teams.save') }}"
            ></team-form>
        </div>
    </div>
</main>
@endsection