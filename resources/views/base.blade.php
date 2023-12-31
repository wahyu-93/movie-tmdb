<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <title>@yield('title')</title>
</head>
<body>
    <div class="w-full h-auto min-h-screen flex flex-col">
        @include('page/header')

        @yield('content')
        
        @include('page/footer')

        @stack('script')
    </div>
</body>
</html>