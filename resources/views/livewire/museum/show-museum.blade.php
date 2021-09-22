<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>
                <a href="{{ route('admin.museum.index') }}">
                    @ucfirst(__('app.list_of', ['name' => __('app.museums')]))
                </a>
            </span> /
            <span>{{ $museum->name }}</span>
        </h2>
    </x-slot>

    <div>
        <div class="w-3/12 mx-auto py-5 sm:px-6 lg:px-8 float-left">
            <ul class="bg-purple-100 list-inside m-5 p-5 w-full">
                <li title="@ucfirst(__('app.museum'))">
                    <h3 class="font-bold text-2xl mb-5">
                        {{ $museum->name }}
                    </h3>
                </li>
                <li title="@ucfirst(__('app.address'))">{{ $museum->address }}</li>
                <li>
                    <span title="@ucfirst(__('app.city'))">{{ $museum->city }}</span>,
                    <span title="@ucfirst(__('app.country'))">{{ $museum->inCountry->name_common_fra }}</span>.
                </li>
                <li class="mt-5" title="@ucfirst(__('app.link'))">
                    <a href="{{ $museum->link }}" target="_blank" rel="noopener">{{ $museum->link }}</a>
                </li>
            </ul>
            @if ($museum->status === 1)
            <ul class="bg-green-100 list-inside m-5 p-5 w-full">
            @else
            <ul class="bg-red-100 list-inside m-5 p-5 w-full">
            @endif
                <li title="@ucfirst(__('app.is_open'))">
                    @if ($museum->status === 1)
                    <span class="text-green-900">@ucfirst(__('app.museum_open')).</span>
                    @else
                    <span class="text-red-900">@ucfirst(__('app.museum_close')).</span>
                    @endif
                </li>
            </ul>
            @if (Auth::user()->can('create', App\Models\Exhibition::class))
            <ul class="bg-gray-200 list-inside m-5 p-5 w-full">
                <li><livewire:modals.edit-museum :museum="$museum" :wire:key="$museum->uuid" /></li>
                <li><livewire:modals.create-exhibition /></li>
                <li><livewire:modals.import-exhibition /></li>
            </ul>
            @endif
        </div>

        <div class="w-9/12 mx-auto py-5 sm:px-6 lg:px-8 float-right">
            @if ($errors->any())
            <div class="bg-red-400 border border-red-500 py-5 sm:px-6 lg:px-8 text-black rounded">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            @if($exhibitions->count() > 0)
            {{ $exhibitions->links() }}
            <div class="py-5">
                <table class="w-full p-5 table-fixed">
                    <thead>
                        <tr>
                            <th class="w-1/12 text-center">@ucfirst(__('app.iteration'))</th>
                            <th class="w-6/12 text-center">@ucfirst(__('app.museums'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.exhibitions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($museum->hasExhibitions() as $exhibition)
                        <tr class="h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('admin.exhibition.show', ['slug' => $exhibition->slug]) }}"
                                    title="{{ $exhibition->title }}" aria-label="{{ $exhibition->title }}">
                                    {{ $exhibition->title }}
                                </a>
                            </td>
                            <td class="text-center">{{ $museum->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $exhibitions->links() }}
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
