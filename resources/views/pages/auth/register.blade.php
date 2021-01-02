@extends('index')

@section('title', 'Register')

@section('content')
    <main>
        <register-form
            login-url="{{ route('site.login') }}"
            save-url="{{ route('site.user.save') }}"
        ></register-form>
    </main>
@endsection