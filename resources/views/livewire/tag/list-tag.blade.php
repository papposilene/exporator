<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>@ucfirst(__('app.list_of', ['name' => __('app.tags')]))</span>
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

            <div class="relative flex items-center justify-between mb-2 w-full">
                <x-forms.input wire:model="search" type="search" class="ml-2" :placeholder="@ucfirst(__('app.search'))" />
            </div>
            {{ $tags->links() }}
            <div class="py-5">
                <table class="w-full p-5 table-fixed">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-3/12 text-center">@ucfirst(__('app.types'))</th>
                            <th class="w-4/12 text-center">@ucfirst(__('app.tags'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.exhibitions'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.ended_at'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                        <tr class="bg-gray-200 border-b border-gray-300 border-dashed h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>@ucfirst($tag->type)</td>
                            <td>
                                @auth
                                <a href="{{ route('admin.tag.show', ['slug' => $tag->slug]) }}"
                                    title="{{ $tag->name }}" aria-label="{{ $tag->name }}">
                                @else
                                <a href="{{ route('front.tag.show', ['slug' => $tag->slug]) }}"
                                    title="{{ $tag->name }}" aria-label="{{ $tag->name }}">
                                @endauth
                                    @ucfirst($tag->name)
                                </a>
                            </td>
                            <td class="text-center">{{ 'test' }}</td>
                            <td class="text-center"></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $tags->links() }}
        </div>
    </div>
</div>
