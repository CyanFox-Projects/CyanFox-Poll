<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    @vite('resources/css/app.css')
    @vite('resources/css/app.js')

    @php
        $unsplash = unsplash()->returnBackground()
    @endphp
</head>
<body>

<div class="flex flex-col justify-between relative min-h-screen">
    <div class="absolute inset-0 z-[-1]" style="{{ $unsplash['css'] }}"></div>

    <div class="flex flex-col md:justify-center md:items-center">
        <p class="flex items-center justify-center mb-6 text-2xl font-semibold">
            <img class="w-32 h-32" src="{{ asset("img/Logo.svg") }}" alt="Logo">
            <span
                class="text-4xl font-bold brand-text text-white lg:block hidden">{{ config('app.name') }}</span>
        </p>
        <div class="card bg-base-200 lg:w-1/4 sm:min-w-96 sm:w-1/8 w-auto">
            <div class="card-body">


                <span class="text-7xl text-center text-white font-semibold">@yield('code')</span>
                <span class="text-3xl text-center text-white font-semibold">@yield('message')</span>

                <div class="divider mt-3"></div>

                <div class="mt-2 flex justify-between gap-3">
                    <a href="{{ url()->previous() }}"
                       class="btn btn-neutral flex-grow"
                       wire:navigate>{{ __('messages.buttons.back') }}</a>

                    <a href="{{ route('home')  }}"
                       class="btn btn-info flex-grow"
                       wire:navigate>{{ __('errors.buttons.home') }}</a>
                </div>
            </div>
        </div>
    </div>
    @if($unsplash['error'] == null)
        <div class="pl-6 pb-4 text-white">
            <span class="text-sm" id="credits" wire:ignore><a id="photo"
                                                              href="{{ $unsplash['photo'] }}/{{ config('unsplash.utm') }}">{{ __('pages/auth/messages.photo') }}</a>, <a
                    id="author"
                    href="{{ $unsplash['authorURL'] }}/{{ config('unsplash.utm') }}">{{ $unsplash['author'] }}</a>, <a
                    href="https://unsplash.com/{{ config('unsplash.utm') }}">Unsplash</a></span>
        </div>
    @endif
</div>

</body>
</html>
