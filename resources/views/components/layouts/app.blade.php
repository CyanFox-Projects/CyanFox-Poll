<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" data-theme="dark" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config('app.name') }}
        | {{ $title ?? '' }}</title>

    <link rel="icon" type="image/svg" href="{{ asset('img/Logo.svg') }}">

    @filamentStyles
    @vite('resources/css/app.css')
    @livewireStyles
    @livewireScripts
</head>
<body class="antialiased flex flex-col min-h-screen">
@livewire('notifications')
@livewire('wire-elements-modal')

<x-navigation.navbar></x-navigation.navbar>

{{ $slot }}

<x-navigation.footer></x-navigation.footer>

@filamentScripts
@vite('resources/js/app.js')
<script src="{{ asset('js/logger.js') }}"></script>

</body>
</html>
