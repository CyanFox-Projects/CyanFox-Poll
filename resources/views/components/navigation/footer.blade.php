<footer class="footer p-9 bg-base-200 text-base-content mt-auto z-0">
    <nav>
        <header class="footer-title">{{ __('navigation.footer.links') }}</header>
        <a class="link link-hover" href="https://github.com/CyanFox-Projects"><i class="bi bi-github"></i>
            {{ __('navigation.footer.github') }}</a>

        <a class="link link-hover" href="https://cyanfox.de"><i class="icon-globe"></i>
            {{ __('navigation.footer.website') }}</a>
    </nav>

    @if(config('legal.impress') !== null && config('legal.privacy') !== null)
        <nav>
            <header class="footer-title">{{ __('navigation.footer.legal') }}</header>

            @if(config('legal.impress') !== null)
                <a class="link link-hover" href="{{ route('impress') }}" wire:navigate><i
                        class="icon-badge-info"></i> {{ __('navigation.footer.impress') }}</a>
            @endif

            @if(config('legal.privacy') !== null)
                <a class="link link-hover" href="{{ route('privacy') }}" wire:navigate><i
                        class="icon-badge-info"></i> {{ __('navigation.footer.privacy') }}</a>
            @endif
        </nav>
    @endif
</footer>
<footer class="footer px-10 py-4 border-t bg-base-200 text-base-content border-base-300">
    <aside class="items-center grid-flow-col">
        <img src="{{ asset('img/Logo.svg') }}" alt="Logo" class="size-12">
        <p>{{ config('app.name') }} <br>{!! __('navigation.footer.made_with_love') !!}</p>
    </aside>
</footer>
