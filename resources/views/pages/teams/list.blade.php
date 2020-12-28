@extends('index')

@section('content')
<main>
    <div class="container pt-5">
        <div class="row">
            <div class="col-md-10">
                <h2 class="mb-3">Teams</h2>
            </div>
            <div class="col">
                <a href="{{ route('site.teams.form') }}" class="btn btn-primary w-100 mb-5">
                    Add Team
                </a>
            </div>
        </div>
        <teams-table
            :teams='@JSON($teams)'
            form-route="{{ route('site.teams.form') }}"
        ></teams-table>
    </div>
</main>
@endsection