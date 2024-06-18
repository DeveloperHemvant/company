<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <!-- Google fonts-->
        
        <title>@yield('title')</title>
        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600&display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" rel="stylesheet" />
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
      {{-- <link rel="icon" href="{{ Vite::asset('resources/images/fvicon1.png') }}" sizes="32x32"> --}}
      <link rel="icon" type="image/x-icon" href="{{ Vite::asset('resources/images/icon03.png') }}">

        @vite(['resources/css/custom.css','resources/slick/slick.css','resources/slick/slick-theme.css','resources/slick/slick.min.js',])
       
        <!-- Styles -->
        @livewireStyles
    </head>
    <body>
        
       
            {{ $slot }}
        

        @livewireScripts
        
        @vite([
        'resources/js/scripts.js',])
    </body>
</html>
