@section('title', $country->name_common_fra)

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>
                <a href="{{ route('admin.country.index') }}">
                    @ucfirst(__('app.list_of', ['name' => __('app.countries')]))
                </a>
            </span> /
            <span>{{ $country->name_common_fra }}</span>
        </h2>
    </x-slot>

    <div class="flex w-full max-w-7xl mx-auto">
        <div class="mx-auto md:w-1/4 py-5 px-6">
            <ul class="bg-indigo-100 list-inside md:mt-5 md:mr-5 p-5 w-full">
                <li title="@ucfirst(__('app.name_common'))">
                    <h3 class="font-bold text-2xl mb-5">
                        {{ $country->flag }} {{ $country->name_common_fra }}
                    </h3>
                </li>
                <li>
                    <span title="@ucfirst(__('app.name_official'))">{{ $country->name_official_fra }}</span>
                    (<span title="@ucfirst(__('app.cca2'))">@uppercase($country->cca2)</span>,
                    <span title="@ucfirst(__('app.cca3'))">@uppercase($country->cca3)</span>).
                </li>
                <li>
                    <span title="@ucfirst(__('app.region'))">{{ $country->region }}</span>,
                    <span title="@ucfirst(__('app.subregion'))">{{ $country->subregion }}.</span>
                </li>
            </ul>
        </div>

        <div class="mx-auto lg:w-3/4 py-5 px-6">
            @if ($errors->any())
            <div class="bg-red-400 border border-red-500 py-5 text-black">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($places->count() > 0)
            <div class="flex flex-wrap justify-end">
                <x-forms.input wire:model="search" type="search" class="relative float-right h-9 ml-2 mb-3" :placeholder="@ucfirst(__('app.search'))" />
                {{ $places->links() }}
            </div>
            <div class="py-5">
                <table class="w-full p-5 table-fixed">
                    <thead>
                        <tr class="bg-bluegray-700 dark:bg-gray-900 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.cities'))</th>
                            <th class="w-6/12 text-center">@ucfirst(__('app.places'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.types'))</th>
                            <th class="w-6/12 text-center">@ucfirst(__('app.status'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.exhibitions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($museums as $museum)
                        <tr class="h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $place->city }}</td>
                            <td>
                                <a href="{{ route('front.place.show', ['slug' => $place->slug]) }}"
                                    title="{{ $place->name }}" aria-label="{{ $place->name }}">
                                    {{ $place->name }}
                                </a>
                            </td>
                            <td class="text-center">@ucfirst(__('app.' . Str::slug($place->type, '_')))</td>
                            <td class="text-center">{{ $place->status }}</td>
                            <td class="text-center">{{ $place->hasExhibitions()->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $places->links() }}
            @else
            <div class="py-5">
                <p class="text-center py-10">
                    @ucfirst(__('app.nothing'))
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
