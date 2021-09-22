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
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">
            <ul class="inline-flex space-x-4 w-full">
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.flag'))">{{ $museum->name }}</li>
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.name_common'))">{{ $museum->address }}</li>
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.name_official'))">{{ $museum->city }}</li>
                <li class="flex-initial bg-gray-300 rounded p-2"
                    title="@ucfirst(__('app.cca2'))">{{ $museum->inCountry->name_common_fra }}</li>
            </ul>
        </div>
    </div>

    @if($museum->has_exhibitions_count > 0)
    <div>
        <div class="max-w-7xl mx-auto py-5 sm:px-6 lg:px-8">

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
