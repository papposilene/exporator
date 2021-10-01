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
                site de référencement des expositions temporaires de Paris.
            </p>
            <p class="">
                L'Exporateur permet de visualiser l'ensemble des expositions temporaires parisiennes sous
                trois formes différentes, à savoir :
                <ol class="list-inside list-decimal mb-5">
                    <li>
                        <a href="{{ route('front.exhibition.index') }}" class="text-blue-700 hover:text-red-600">une simple liste des expositions</a>,
                    </li>
                    <li>
                        <a href="{{ route('front.exhibition.map') }}" class="text-blue-700 hover:text-red-600">une cartographie des expositions en cours</a>,
                    </li>
                    <li>
                        <a href="{{ route('front.exhibition.timeline') }}" class="text-blue-700 hover:text-red-600">enfin une chronologie des expositions fraîchement achevées, en cours et prochaines</a>.
                    </li>
                </ol>
            </p>
            <p class="mb-3">
                Cette application web a été réalisée avec le <a href="https://laravel.com/docs/8.x"
                 class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">framework Laravel 8</a>,
                 <a href="https://laravel-livewire.com/docs/2.x/" class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">Livewire 2</a>
                 et <a href="https://tailwindcss.com/" class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">TailwindCSS 2</a>.
                 Enfin, son code-source complet est <a href="https://github.com/papposilene/exporator"
                class="text-blue-700 hover:text-red-600" target="_blank" rel="noopener">disponible sur Github</a>.
            </p>
        </div>
    </div>
</div>
