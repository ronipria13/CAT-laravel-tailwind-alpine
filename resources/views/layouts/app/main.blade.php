<!doctype html>
<html>
<head>
  
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    
    @livewireStyles
    <link rel="icon" type="image/png" href="{{ asset('images/985px-Laravel.svg.png') }}">
    <title>{{ env("APP_NAME", "Laravel") }}@yield('title')</title>
</head>
<body>
    <div>        
        <div x-data="{ sidebarOpen: false }" class="flex h-screen bg-gray-200">


            @include('layouts.app.partials.sidebar')


            <div class="flex-1 flex flex-col overflow-hidden">

                @include('layouts.app.partials.header')

                <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                    <div class="container mx-auto px-6 py-8">
                        @yield('content')
                    </div>
                </main>
            </div>
        </div>
    </div>

    <script src="{{ mix('js/app.js') }}" defer></script>
    <script src="{{ mix('js/sweetalert2.js') }}" defer></script>
    @livewireScripts
    @yield('_inJs')
</body>
</html>