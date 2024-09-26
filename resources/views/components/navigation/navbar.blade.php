<div class="navbar bg-base-200">
    <div class="navbar-start space-x-4">
        <a href="{{ route('home') }}" wire:navigate><img src="{{ asset('img/Logo.svg') }}" alt="Logo"
                                                                       class="w-16 h-16"></a>
        <a href="{{ route('polls.create') }}" class="hover:text-gray-600 sm:block hidden" wire:navigate><i
                class="icon-align-end-horizontal"></i> {{ __('navigation.navbar.create_poll') }}</a>
        <a href="{{ route('polls.find') }}" class="hover:text-gray-600 sm:block hidden" wire:navigate><i
                class="icon-search"></i> {{ __('navigation.navbar.find_poll') }}</a>
    </div>

    <div class="navbar-end space-x-4 mr-3 sm:flex hidden">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn m-1"><i class="icon-languages"></i> {{ __('navigation.navbar.language') }}</div>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="{{ route('lang.de') }}"><kbd class="kbd kbd-xs">DE</kbd> {{ __('messages.languages.de') }}</a></li>
                <li><a href="{{ route('lang.en') }}"><kbd class="kbd kbd-xs">EN</kbd> {{ __('messages.languages.en') }}</a></li>
            </ul>
        </div>
    </div>

    <div class="navbar-end sm:hidden flex">
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn m-1"><i class="icon-languages"></i> {{ __('navigation.navbar.language') }}</div>
            <ul tabindex="0" class="dropdown-content z-[1] menu p-2 shadow bg-base-100 rounded-box w-52">
                <li><a href="{{ route('lang.de') }}"><kbd class="kbd kbd-xs">DE</kbd> {{ __('messages.languages.de') }}</a></li>
                <li><a href="{{ route('lang.en') }}"><kbd class="kbd kbd-xs">EN</kbd> {{ __('messages.languages.en') }}</a></li>
            </ul>
        </div>
        <div class="dropdown dropdown-end">
            <div tabindex="0" role="button" class="btn btn-ghost btn-circle">
                <i class="icon-menu font-semibold text-xl"></i>
            </div>
            <ul tabindex="0"
                class="menu menu-sm dropdown-content mt-3 z-[1] p-2 shadow bg-base-100 rounded-box w-52">
                <li>
                    <a class="flex items-center w-full h-12 rounded hover:bg-base-300"
                       href="{{ route('polls.create') }}" wire:navigate>
                        <i class="icon-align-end-horizontal"></i>
                        <span class="ml-2 text-sm font-medium">{{ __('navigation.navbar.create_poll') }}</span>
                    </a>
                </li>
                <li>
                    <a class="flex items-center w-full h-12 rounded hover:bg-base-300"
                       href="{{ route('polls.find') }}" wire:navigate>
                        <i class="icon-search"></i>
                        <span class="ml-2 text-sm font-medium">{{ __('navigation.navbar.find_poll') }}</span>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</div>
