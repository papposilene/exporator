<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('app.list_of', ['name' => __('app.countries')]) }}
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        {{ $countries->links() }}
        <div class="p-5">
            <table class="w-full p-5 table-fixed">
                <thead>
                    <tr>
                        <th class="w-1/12 text-center">@ucfirst(__('app.iteration'))</th>
                        <th class="w-7/12 text-center">@ucfirst(__('app.countries'))</th>
                        <th class="w-2/12 text-center">@ucfirst(__('app.museums'))</th>
                        <th class="w-2/12 text-center">@ucfirst(__('app.actions'))</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($countries as $country)
                    <tr class="h-12 w-12 p-4">
                        <td class="text-center">{{ $loop->iteration }}</td>
                        <td>
                            <a href="{{ route('admin.country.show', ['cca3' => $country->cca3]) }}"
                                title="{{ $country->name_common_fra }}" aria-label="{{ $country->name_common_fra }}">
                                {{ $country->name_common_fra }}
                            </a>
                        </td>
                        <td class="text-center">{{ $country->hasMuseums()->count() }}</td>
                        <td class="text-center">
                            <a href="{{ route('admin.country.show', ['cca3' => $country->cca3]) }}"
                                class="hover:text-gray-900 dark:hover:text-gray-50"
                                title="{{ $country->name_common_fra }}" aria-label="{{ $country->name_common_fra }}">
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
        {{ $countries->links() }}
    </div>
</x-app-layout>
