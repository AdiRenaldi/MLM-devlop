<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>@yield('title') - Rafa Beauty</title>
    <link rel="icon" href="{{ asset('images/icon/logo.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @yield('page-style')
</head>
{{-- <body class="flex flex-col justify-start min-h-screen">
        @if(isset($page) && $page=="login")
            @yield('content')
        @else
            @include('pages.layouts.navbar.navbar')
            @include('pages.layouts.sidebar.sidebar')
            @yield('content')
            @include('pages.layouts.footer.footer')
        @endif
</body> --}}

<body class="flex flex-col min-h-screen">
    @if(isset($page) && $page=="login")
        @yield('content')
    @else
        @include('pages.layouts.navbar.navbar')
        @include('pages.layouts.sidebar.sidebar')

        <main class="flex-grow">
            @yield('content')
        </main>

        @include('pages.layouts.footer.footer')
    @endif
</body>
@yield('page-script')
</html>