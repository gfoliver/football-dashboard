<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta content="{{csrf_token()}}" name="csrf-token">
    <title>{{ env('APP_NAME') }}</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>
    <div id="app">
        @include('partials.header')
        @yield('content')
    </div>
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>