<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $country->flag }} {{ $country->name_common_fra }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <ul class="inline-flex space-x-4 w-full">
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.flag'))">{{ $country->flag }}</li>
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.name_common'))">{{ $country->name_common_fra }}</li>
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.name_official'))">{{ $country->name_official_fra }}</li>
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.cca2'))">@uppercase($country->cca2)</li>
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.cca3'))">@uppercase($country->cca3)</li>
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.region'))">{{ $country->region }}</li>
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.subregion'))">{{ $country->subregion }}</li>
            </ul>
        </div>
    </div>

    @if($country->has_museums_count > 0)
    <div>
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">

        <div class="py-5">
            <table class="w-full p-5 table-fixed">
                <thead>
                    <tr>
                        <th class="w-1/12 text-center">@ucfirst(__('app.iteration'))</th>
                        <th class="w-6/12 text-center">@ucfirst(__('app.museums'))</th>
                        <th class="w-2/12 text-center">@ucfirst(__('app.exhibitions'))</th>
                        <th class="w-2/12 text-center">@ucfirst(__('app.actions'))</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($country->hasMuseums() as $museum)
                    <tr class="h-12 w-12 p-4">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('admin.museum.show', ['slug' => $museum->slug]) }}"
                                title="{{ $museum->name }}" aria-label="{{ $museum->name }}">
                                {{ $museum->name }}
                            </a>
                        </td>
                        <td class="text-center">{{ $museum->hasExhibitions()->count() }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.museum.show', ['slug' => $museum->slug]) }}"
                                class="hover:text-gray-900 dark:hover:text-gray-50"
                                title="{{ $museum->name }}" aria-label="{{ $museum->name }}">
                                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 21h7a2 2 0 002-2V9.414a1 1 0 00-.293-.707l-5.414-5.414A1 1 0 0012.586 3H7a2 2 0 00-2 2v11m0 5l4.879-4.879m0 0a3 3 0 104.243-4.242 3 3 0 00-4.243 4.242z"></path>
                                </svg>
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        </div>
    </div>
    @else
    <div>
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <p class="text-center py-10">
                @ucfirst(__('app.nothing'))
            </p>
        </div>
    </div>
    @endif
</div>
