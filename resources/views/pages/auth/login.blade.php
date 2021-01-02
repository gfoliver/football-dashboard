@extends('index')

@section('title', 'Login')

@section('content')
    <login-form
        post-url="{{ route('auth.login') }}"
    ></login-form>
@endsection