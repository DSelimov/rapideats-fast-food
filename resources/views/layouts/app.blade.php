<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <script src="{{ asset('js/cart.js') }}"></script>
    <script src="{{ asset('js/imgpreview.js') }}"></script>


    <!-- Vite Scripts and Styles -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gray-100 h-screen flex flex-col antialiased leading-none font-sans">
<div id="app" class="flex-grow flex flex-col">
    <header class="py-6" style="background-color: #7b5b68; background-image: linear-gradient(225deg, #7b5b68 0%, #83511f 22%, #2B86C5 69%);">
        <div class="container mx-auto flex justify-between items-center px-6">
            <div>
                <a href="{{ url('/') }}" class="text-lg font-semibold text-gray-100 no-underline text-[30px]">
                    {{ config('app.name', 'Laravel') }}
                </a>
            </div>
            <nav class="space-x-4 text-gray-300 text-sm sm:text-base">
                @php
                    $navItems = [
                        ['name' => 'Home', 'url' => '/'],
                        ['name' => 'Cart', 'url' => '/cart'],
                    ];
                @endphp

                @foreach($navItems as $item)
                    <a class="no-underline hover:bg-gray-800 transition duration-300 rounded-lg py-2 px-4 text-[22px] text-gray-100" href="{{ $item['url'] }}">
                        {{ $item['name'] }}
                    </a>
                @endforeach

                @if(Auth::check())
                    <a class="no-underline hover:bg-gray-700 transition duration-300 rounded-lg py-2 px-4 text-[22px] text-gray-100" href="/profile">Profile</a>
                @endif

                @guest
                    <a class="no-underline hover:bg-gray-700 transition duration-300 rounded-lg py-2 px-4 text-[22px] text-gray-100" href="{{ route('login') }}">{{ __('Login') }}</a>
                    @if (Route::has('register'))
                        <a class="no-underline hover:bg-gray-700 transition duration-300 rounded-lg py-2 px-4 text-[22px] text-gray-100" href="{{ route('register') }}">{{ __('Register') }}</a>
                    @endif
                @else
                    <a href="{{ route('logout') }}"
                       class="no-underline hover:bg-gray-700 transition duration-300 rounded-lg py-2 px-4 text-[22px] text-gray-100"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="hidden">
                        {{ csrf_field() }}
                    </form>
                @endguest
            </nav>
        </div>
    </header>

    <main class="flex-grow">
        @yield('content')
    </main>

    @include('layouts.footer')
</div>
</body>
</html>
