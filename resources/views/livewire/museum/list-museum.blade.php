<div>
    <x-slot name="header">
        @if (Auth::user()->can('create', App\Models\Museum::class))
        <livewire:modals.import-museum />
        <livewire:modals.create-museum />
        @endif
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @ucfirst(__('app.list_of', ['name' => __('app.museums')]))
        </h2>
    </x-slot>

    <div>
        @if ($errors->any())
        <div class="bg-red-400 border border-red-500 text-black">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            {{ $museums->links() }}
            <div class="py-5">
                <table class="w-full p-5 table-fixed">
                    <thead>
                        <tr>
                            <th class="w-1/12 text-center">@ucfirst(__('app.iteration'))</th>
                            <th class="w-7/12 text-center">@ucfirst(__('app.museums'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.exhibitions'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.actions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($museums as $museum)
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
            {{ $museums->links() }}
        </div>
    </div>
</div>
