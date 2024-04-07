<div>
    <section id="main">
        <div class="hero min-h-screen" id="mainHero">
            <div class="hero-overlay bg-opacity-60"></div>
            <div class="hero-content text-center text-white flex flex-col items-center">
                <h1 class="mb-5 text-5xl font-bold obitron text-cyan-400">{{ config('app.name') }}</h1>
                <div class="flex justify-center items-center font-semibold text-lg mb-4 max-w-sm">
                    <div class="md:whitespace-pre sm:whitespace-normal sm:overflow-wrap sm:break-word" id="text"></div>
                </div>
                <div class="flex flex-col sm:flex-row gap-3 justify-center">
                    <a href="{{ route('polls.create') }}" class="btn btn-primary"><i
                                class="icon-align-end-horizontal"></i> {{ __('sites/home.buttons.create_poll') }}</a>
                    <a href="{{ route('polls.find') }}" class="btn btn-accent"><i
                                class="icon-search"></i> {{ __('sites/home.buttons.find_poll') }}</a>
                </div>
            </div>
        </div>
    </section>
    <section id="what_we_use">
        <div class="grid sm:grid-cols-1 md:grid-cols-2 content-center md:mx-20 mx-10 min-h-screen">
            <div class="max-w-md mb-4">
                <h1 class="mb-5 text-5xl font-bold">{{ __('sites/home.what_did_we_use.title') }}</h1>
                <p class="mb-5">{!! __('sites/home.what_did_we_use.content') !!}</p>
            </div>

            <div class="relative grid grid-cols-2 gap-4 h-96">
                <div class="sm:absolute sm:top-8 sm:right-14 sm:transform sm:scale-85 sm:rotate-12">
                    <a href="https://tailwindcss.com"><img src="{{ asset('img/brands/TailwindCSS.svg') }}"
                                                           alt="Tailwind"
                                                           class="w-20 h-20"></a>
                </div>
                <div class="sm:absolute sm:top-14 sm:left-20 sm:transform sm:scale-95 sm:rotate-15">
                    <a href="https://daisyui.com"><img src="{{ asset('img/brands/DaisyUI.svg') }}" alt="DaisyUI"
                                                       class="w-20 h-20"></a>
                </div>
                <div class="grid sm:absolute sm:bottom-20 sm:right-1/2 sm:transform sm:scale-80 sm:rotate-10">
                    <a href="https://livewire.laravel.com"><img src="{{ asset('img/brands/Livewire.svg') }}"
                                                                alt="Livewire"
                                                                class="w-20 h-20"></a>
                </div>
                <div class="grid sm:absolute sm:bottom-1/3 sm:right-1/4 sm:transform sm:scale-90 sm:rotate-9">
                    <a href="https://laravel.com"><img src="{{ asset('img/brands/Laravel.svg') }}" alt="Laravel"
                                                       class="w-20 h-20"></a>
                </div>
            </div>
        </div>
    </section>


    <section id="open_source">
        <div class="hero min-h-screen bg-base-200">
            <div class="hero-content text-center flex flex-col items-center">
                <div class="max-w-md mb-7">
                    <h1 class="mb-5 text-5xl font-bold">{{ __('sites/home.open_source.title') }}</h1>
                    <p class="mb-5">{!! __('sites/home.open_source.content') !!}</p>
                    <div class="flex flex-col sm:flex-row gap-3 justify-center">
                        <a href="https://github.com/CyanFox-Projects/CyanFox-Poll" class="btn btn-neutral"><i
                                    class="bi bi-github"></i> {{ __('sites/home.buttons.github') }}</a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/dist/typed.min.js') }}"></script>
    <script>
        function generateGradient() {
            const hexValues = ["0", "1", "2", "3", "4", "5", "6", "7", "8", "9", "a", "b", "c", "d", "e"];

            function populate(a) {
                for (let i = 0; i < 6; i++) {
                    const x = Math.round(Math.random() * 14);
                    const y = hexValues[x];
                    a += y;
                }
                return a;
            }

            const newColor1 = populate('#');
            const newColor2 = populate('#');
            const newColor3 = populate('#');
            const newColor4 = populate('#');
            const angle = Math.round(Math.random() * 360);

            const mainHero = document.getElementById('mainHero');
            mainHero.style.background = `linear-gradient(${angle}deg, ${newColor1}, ${newColor2}, ${newColor3}, ${newColor4})`;
            mainHero.style.backgroundSize = '400% 400%';
            mainHero.style.animation = 'gradient 15s ease infinite';
        }

        document.addEventListener('DOMContentLoaded', function () {
            generateGradient();
        });

        new Typed("#text", {
            strings: ["", "{{ __('sites/home.animations.1') }}",
                "{{ __('sites/home.animations.2') }}", "{{ __('sites/home.animations.3') }}",
                "{{ __('sites/home.animations.4') }}", "{{ __('sites/home.animations.5') }}",
                "{{ __('sites/home.animations.6') }}"],
            typeSpeed: 90,
            backSpeed: 30,
            loop: true,
        });
    </script>
    <style>
        #mainHero {
            background-size: 400% 400%;
            animation: gradient 15s ease infinite;
        }

        @keyframes gradient {
            0% {background-position: 0% 50%;}
            50% {background-position: 100% 50%;}
            100% {background-position: 0% 50%;}
        }

        html {
            scroll-behavior: smooth;
        }

        .obitron {
            font-family: 'Orbitron Medium', sans-serif;
        }
    </style>
</div>
