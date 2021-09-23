<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>
                <a href="{{ route('admin.country.index') }}">
                    @ucfirst(__('app.list_of', ['name' => __('app.countries')]))
                </a>
            </span> /
            <span>{{ $country->name_common_fra }}</span>
        </h2>
    </x-slot>

    <div>
        <div class="w-3/12 mx-auto py-5 sm:px-6 lg:px-8 float-left">
            <ul class="bg-indigo-100 list-inside m-5 p-5 w-full">
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

        <div class="w-9/12 mx-auto py-5 sm:px-6 lg:px-8 float-right">
            @if ($errors->any())
            <div class="bg-red-400 border border-red-500 py-5 text-black">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($museums->count() > 0)
            {{ $museums->links() }}
            <div class="py-5">
                <table class="w-full p-5 table-fixed">
                    <thead>
                        <tr>
                            <th class="w-1/12 text-center">@ucfirst(__('app.iteration'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.cities'))</th>
                            <th class="w-6/12 text-center">@ucfirst(__('app.museums'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.types'))</th>
                            <th class="w-6/12 text-center">@ucfirst(__('app.status'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.exhibitions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($museums as $museum)
                        <tr class="h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $museum->city }}</td>
                            <td>
                                <a href="{{ route('admin.museum.show', ['slug' => $museum->slug]) }}"
                                    title="{{ $museum->name }}" aria-label="{{ $museum->name }}">
                                    {{ $museum->name }}
                                </a>
                            </td>
                            <td class="text-center">{{ $museum->type }}</td>
                            <td class="text-center">{{ $museum->status }}</td>
                            <td class="text-center">{{ $museum->hasExhibitions()->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $museums->links() }}
            @else
            <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
                <p class="text-center py-10">
                    @ucfirst(__('app.nothing'))
                </p>
            </div>
            @endif
        </div>
    </div>
</div>
