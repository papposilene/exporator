<div>
    <x-slot name="header">
        @auth
        @if (Auth::user()->can('create', App\Models\Museum::class))
        <livewire:modals.import-museum />
        <livewire:modals.create-museum />
        @endif
        @endauth
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>@ucfirst(__('app.list_of', ['name' => __('app.museums')]))</span>
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            @if ($errors->any())
            <div class="bg-red-400 border border-red-500 py-5 text-black">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div>
                <x-forms.input wire:model="search" type="search" class="relative float-right h-9 ml-2 mb-3" :placeholder="@ucfirst(__('app.search'))" />
                {{ $museums->links() }}
            </div>
            <div class="py-5">
                <table class="w-full p-5 table-fixed">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.types'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.cities'))</th>
                            <th class="w-4/12 text-center">@ucfirst(__('app.museums'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.status'))</th>
                            <th class="w-1/12 text-center">@ucfirst(__('app.exhibitions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($museums as $museum)
                        <tr class="bg-gray-200 border-b border-gray-300 border-dashed h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>@ucfirst(__('app.' . Str::slug($museum->hasType->type, '_')))</td>
                            <td>{{ $museum->city }}</td>
                            <td>
                                @auth
                                <a href="{{ route('admin.museum.show', ['slug' => $museum->slug]) }}"
                                    title="{{ $museum->name }}" aria-label="{{ $museum->name }}">
                                @else
                                <a href="{{ route('front.museum.show', ['slug' => $museum->slug]) }}"
                                    title="{{ $museum->name }}" aria-label="{{ $museum->name }}">
                                @endauth
                                    {{ $museum->name }}
                                </a>
                            </td>
                            <td class="text-center">
                                @if ($museum->status === 1)
                                <span class="text-green-900">@ucfirst(__('app.museum_open'))</span>
                                @else
                                <span class="text-red-900">@ucfirst(__('app.museum_close'))</span>
                                @endif
                            </td>
                            <td class="text-center">{{ $museum->hasExhibitions()->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $museums->links() }}
        </div>
    </div>
</div>
