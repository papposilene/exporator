<div class="flex flex-row w-full px-4 md:px-0 md:mt-8 mb-16 text-gray-800 leading-normal">
    <!-- Table: Territories -->
    <div class="w-full bg-gray-800 border border-gray-800 rounded shadow">
        <div class="border-b border-gray-800 p-3">
            <nav aria-label="Breadcrumb" class="font-bold uppercase text-gray-700 dark:text-gray-400">
                {{ __('app.list_of', ['name' => __('app.countries')]) }}
            </nav>
        </div>
        {{ $countries->links() }}
        <div class="p-5">
            <table class="w-full p-5 table-fixed text-gray-700 dark:text-gray-400">
                <thead>
                    <tr>
                        <th class="w-1/12 text-center">@ucfirst(__('app.iteration'))</th>
                        <th class="w-4/12 text-center">@ucfirst(__('app.countries'))</th>
                        <th class="w-1/12 text-center">@ucfirst(__('app.museums'))</th>
                        <th class="w-1/12 text-center">@ucfirst(__('app.actions'))</th>
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
    <!-- /Table: Territories -->
</div>
