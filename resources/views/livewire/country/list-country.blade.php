<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>@ucfirst(__('app.list_of', ['name' => __('app.countries')]))</span>
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <div>
                <x-forms.input wire:model="search" type="search" class="relative float-right ml-3 mb-3" :placeholder="@ucfirst(__('app.search'))" />
                {{ $countries->links() }}
            </div>
            <div class="py-5">
                <table class="w-full p-5 table-fixed">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-1/12 text-center">@ucfirst(__('app.flags'))</th>
                            <th class="w-6/12 text-center">@ucfirst(__('app.countries'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.museums'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($countries as $country)
                        <tr class="h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $country->flag }}</td>
                            <td>
                                <a href="{{ route('admin.country.show', ['cca3' => $country->cca3]) }}"
                                    title="{{ $country->name_common_fra }}" aria-label="{{ $country->name_common_fra }}">
                                    {{ $country->name_common_fra }}
                                </a>
                            </td>
                            <td class="text-center">{{ $country->hasMuseums()->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $countries->links() }}
        </div>
    </div>
</div>
