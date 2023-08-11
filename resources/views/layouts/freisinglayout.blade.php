<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="icon" type="image/svg+xml" href="/img/favicon.png">
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <!--link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" /-->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Source+Sans+3:ital,wght@0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

    <script src="{{asset('js/jquery-3.7.0.min.js')}}"></script>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Lato:ital,wght@0,100;0,300;0,400;0,700;0,900;1,100;1,300;1,400;1,700;1,900&family=Montserrat:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');
    </style>
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/css/freising.css', 'resources/js/app.js'])
</head>
<body>
    <div class="hidden lg:block">
        @include('clients.freising.navigation')
        <div class="font-sans text-gray-900  w-full ">
            @yield('content');
        </div>
        @include('clients.freising.footer')
    </div> 
    <div class="lg:hidden flex h-screen w-full items-center justify-center ">
        <div class="bg-blue-400 text-black p-5 rounded-xl">
        Diese Seite ist noch nicht für mobile Geräte optimiert. <br/>
        Bitte benutzen sie einen Computer mit einem größeren Bildschirm.<br>
        Wir arbeiten aber mit Hochdruck daran.
        </div>
    </div>   
<script>
    $(function() {
        $('#burger').click(function(){
            $('.nav-container').toggle(200);
        })
    });
</script>

</body>
</html>
