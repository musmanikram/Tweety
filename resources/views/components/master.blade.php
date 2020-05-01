<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/main.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app" class="relative">
        <section class="px-8 py-4 mb-6">
            <header class="container mx-auto">
                <h1>
                    <a href="/tweets">
                        <img
                            src="/images/logo.svg"
                            alt="Tweety"
                        >
                    </a>
                </h1>
            </header>
        </section>

        {{ $slot }}

        @if(session('notification'))
            <div ref="notification" class="fixed bg-green-200 p-10 text-black-50" style="right: 20px;bottom:20px;">
                {{ session('notification') }}
            </div>
        @endif
    </div>



    <script src="http://unpkg.com/turbolinks"></script>
</body>
</html>
