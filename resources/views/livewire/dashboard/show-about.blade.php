@section('title', @ucfirst(__('app.about')))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>@ucfirst(__('app.about'))</span>
        </h2>
    </x-slot>

    <div class="flex flex-row flex-wrap max-w-7xl mx-auto py-5 px-6">
        <div class="flex sm:flex-row lg:flex-col flex-grow flex-wrap bg-bluegray-500 text-white lg:mr-3 p-5 rounded shadow w-full">
            <p class="mb-3">
                L'Exporateur, mot-valise entre <em>exposition</em> et <em>explorateur</em>, est un (énième ?)
                site de référencement des expositions temporaires à Paris et ses proches alentours.
            </p>
            <p>
                L'Exporateur permet de visualiser l'ensemble des expositions temporaires parisiennes sous
                deux formes différentes, à savoir :
                <ol class="list-inside list-decimal mb-3">
                    <li>
                        <a href="{{ route('front.exhibition.index') }}" class="hover:text-red-400">une liste des expositions temporaires</a>,
                    </li>
                    <li>
                        <a href="{{ route('front.exhibition.map') }}" class="hover:text-red-400">une cartographie des expositions en cours</a>.
                    </li>
                </ol>
            </p>
            <p class="mb-3">
                Vous pouvez suivre les actualités, mises à jour et autres informations sur les réseaux sociaux suivants :
                <ol class="list-inside list-none mb-3">
                    <li>
                        <a href="https://twitter.com/lexporateur" class="hover:text-red-400">@lexporateur</a>
                    </li>
                </ol>
            </p>
            <p class="mt-7 mb-3">
                Créée par <a href="https://dev.psln.nl/" class="hover:text-red-600" target="_blank" rel="noopener">Philippe-Alexandre Pierre</a>
                 en 2021, cette application web a été réalisée avec le <a href="https://laravel.com/docs/8.x"
                 class="hover:text-red-600" target="_blank" rel="noopener">framework Laravel 8</a>,
                 <a href="https://laravel-livewire.com/docs/2.x/" class="hover:text-red-600" target="_blank" rel="noopener">Livewire 2</a>
                 et <a href="https://tailwindcss.com/" class="hover:text-red-600" target="_blank" rel="noopener">TailwindCSS 2</a>.
                 Enfin, son code-source complet, sous licence MIT, est <a href="https://github.com/papposilene/exporator"
                class="hover:text-red-600" target="_blank" rel="noopener">disponible sur Github</a>.
            </p>
            <p class="mt-7 mb-3">
                <script type="text/javascript" src="https://cdnjs.buymeacoffee.com/1.0.0/button.prod.min.js" data-name="bmc-button"
                    data-slug="lexporateur" data-color="#FFDD00" data-emoji="" data-font="Bree" data-text="Buy me a coffee" data-outline-color="#000000"
                    data-font-color="#000000" data-coffee-color="#ffffff"></script>
            </p>
        </div>
    </div>
</div>
