@extends('index')

@section('content')
<main>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-10">
                <h2 class="mb-4">Leagues</h2>
            </div>
            <div class="col">
                <a href="#" class="btn btn-primary w-100 mb-5">Add League</a>
            </div>
        </div>
        <leagues-table
            :leagues='@JSON($leagues)'
            form-route=""
            inner-route="{{ route('site.leagues.inner', '') }}"
        ></leagues-table>
    </div>
</main>
@endsection