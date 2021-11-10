<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}"
    prefix="og: http://ogp.me/ns#" x-cloak
    x-data="{darkMode: localStorage.getItem('dark') === 'true'}"
    x-init="$watch('darkMode', val => localStorage.setItem('dark', val))"
    x-bind:class="{'dark': darkMode}">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />
        <meta name="csrf-token" content="{{ csrf_token() }}" />
        <meta name="robots" content="index, follow" />
        <title>@yield('title') - {{ config('app.name', 'Exporator') }}</title>
        <meta name="twitter:card" content="summary" />
        <meta name="twitter:creator" content="@papposilene" />
        <meta property="og:title" content="@yield('title') - {{ config('app.name', 'Exporator') }}" />
        <meta property="og:description" content="L'Exporateur, mot-valise entre exposition et explorateur, est un (énième ?) site de référencement des expositions temporaires à Paris et ses proches alentours." />
        <!-- Fonts -->
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" />
        <!-- Styles -->
        <link rel="stylesheet" href="{{ asset('css/app.css') }}" />
        @livewireStyles
        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>
        @if (App::environment('prod'))
        <!-- Matomo -->
        <script>
        var _paq = window._paq = window._paq || [];
        _paq.push(["setDomains", ["*.exp.psln.nl","*.lexporateur.fr"]]);
        _paq.push(["setDoNotTrack", true]);
        _paq.push(['trackPageView']);
        _paq.push(['enableLinkTracking']);
        (function() {
            var u="//pwk.psln.nl/";
            _paq.push(['setTrackerUrl', u+'matomo.php']);
            _paq.push(['setSiteId', '14']);
            var d=document, g=d.createElement('script'), s=d.getElementsByTagName('script')[0];
            g.async=true; g.src=u+'matomo.js'; s.parentNode.insertBefore(g,s);
        })();
        </script>
        <noscript><p><img src="//pwk.psln.nl/matomo.php?idsite=14&amp;rec=1" style="border:0;" alt="" /></p></noscript>
        <!-- End Matomo Code -->
        @endif
    </head>

    <body class="antialiased font-sans bg-bluegray-100 dark:bg-gray-700" lang="{{ str_replace('_', '-', app()->getLocale()) }}">
        <div class="flex flex-col h-min-screen">
            <livewire:menu />

            <!-- Page Heading -->
            @if (isset($header))
            <header class="flex bg-white dark:bg-gray-900 shadow">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 w-full">
                    {{ $header }}
                </div>
            </header>
            @endif

            <!-- Page Content -->
            <main class="h-min-screen w-full">
                {{ $slot }}
            </main>

            <footer class="flex bg-bluegray-100 dark:bg-gray-700">
                <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8 w-full">
                    <x-footer />
                </div>
            <footer>

            @stack('modals')
        </div>

        @livewireScripts
        @stack('scripts')
    </body>
</html>
