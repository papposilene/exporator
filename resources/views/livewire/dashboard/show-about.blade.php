@section('title', @ucfirst(__('app.about')))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>@ucfirst(__('app.about'))</span>
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <p class="mb-3">
                L'Exporateur, mot-valise entre <em>exposition</em> et <em>explorateur</em>, est un (énième ?)
                site de référencement des expositions temporaires à Paris et ses proches alentours.
            </p>
            <p>
                L'Exporateur permet de visualiser l'ensemble des expositions temporaires parisiennes sous
                trois formes différentes, à savoir :
                <ol class="list-inside list-decimal mb-3">
                    <li>
                        <a href="{{ route('front.exhibition.index') }}" class="text-blue-700 hover:text-red-600">une liste des expositions temporaires</a>,
                    </li>
                    <li>
                        <a href="{{ route('front.exhibition.map') }}" class="text-blue-700 hover:text-red-600">une cartographie des expositions en cours</a>,
                    </li>
                    <li>
                        <a href="{{ route('front.exhibition.calendar') }}" class="text-blue-700 hover:text-red-600">un agenda des expositions fraîchement achevées, en cours et prochaines</a>.
                    </li>
                </ol>
            </p>
            <p class="mb-3">
                Des améliorations sont déjà prévues, telles que la possibilité de se créer un compte d’utilisateur·rice. Cela lui permettra de pouvoir
                indiquer les expositions temporaires qu'il·elle a déjà faites et sa créer ainsi une liste, carte et chronologie des expositions temporaires
                restantes.
            </p>
            <p class="mt-7 mb-3">
                Créée par <a href="https://dev.psln.nl/" class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">Philippe-Alexandre Pierre</a>
                 en 2021, cette application web a été réalisée avec le <a href="https://laravel.com/docs/8.x"
                 class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">framework Laravel 8</a>,
                 <a href="https://laravel-livewire.com/docs/2.x/" class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">Livewire 2</a>
                 et <a href="https://tailwindcss.com/" class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">TailwindCSS 2</a>.
                 Enfin, son code-source complet, sous licence MIT, est <a href="https://github.com/papposilene/exporator"
                class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">disponible sur Github</a>.
            </p>
        </div>
    </div>
</div>
