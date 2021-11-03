@section('title', @ucfirst(__('app.list_of', ['name' => __('app.tags')])))

<div>
    <x-slot name="header">
        @auth
        @if (Auth::user()->can('create', App\Models\Tag::class))
        <livewire:modals.create-tag />
        @endif
        @endauth
        <h2 class="font-semibold text-xl text-bluegray-800 leading-tight">
            <span>@ucfirst(__('app.list_of', ['name' => __('app.tags')]))</span>
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 px-6">
            @if ($errors->any())
            <div class="bg-red-500 border border-red-700 mb-3 p-3 rounded shadow text-white font-bold">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="relative flex items-center justify-between mb-2 w-full">
                <div class="flex flex-wrap">
                    @auth
                    <a href="?filter=" class="flex flex-auto text-base md:rounded-r-none hover:scale-110 focus:outline-none
                        justify-center px-4 py-2 hover:rounded font-bold cursor-pointer
                        hover:bg-bluegray-300 hover:text-black bg-bluegray-200 border duration-200 ease-in-out hover:border-bluegray-400 transition">
                        <div class="flex leading-5">@ucfirst(__('app.all'))</div>
                    </a>
                    <a href="?filter=followed" class="flex flex-auto text-base md:rounded-r-none hover:scale-110 focus:outline-none
                        justify-center px-4 py-2 hover:rounded font-bold cursor-pointer
                        hover:bg-bluegray-300 hover:text-black bg-bluegray-200 border duration-200 ease-in-out hover:border-bluegray-400 transition">
                        <div class="flex leading-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 h-6 w-6" fill="yes" viewBox="0 0 24 24" stroke="currentColor" title="@ucfirst(__('app.followed'))">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                    </a>
                    @endauth
                </div>
                <x-forms.input wire:model="search" type="search" class="ml-2" :placeholder="@ucfirst(__('app.search'))" />
            </div>
            {{ $tags->links() }}
            <div class="py-5">
                <table class="w-full p-5 table-fixed shadow">
                    <thead>
                        <tr class="bg-bluegray-700 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-1/12 text-center hidden lg:table-cell">@ucfirst(__('app.followed'))</th>
                            <th class="w-4/12 text-center">@ucfirst(__('app.types'))</th>
                            <th class="w-5/12 text-center">@ucfirst(__('app.tags'))</th>
                            <th class="w-1/12 text-center">@ucfirst(__('app.exhibitions'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($tags as $tag)
                        <tr class="bg-bluegray-200 border-b border-bluegray-300 border-dashed h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="hidden lg:table-cell">
                                <livewire:interfaces.follow-tag :tag="$tag" :wire:key="$tag->id" />
                            </td>
                            <td>@ucfirst($tag->type)</td>
                            <td>
                                <a href="{{ route('front.tag.show', ['slug' => $tag->slug]) }}"
                                    title="{{ $tag->name }}" aria-label="{{ $tag->name }}">
                                    @ucfirst($tag->name)
                                </a>
                            </td>
                            <td class="text-center">{{ $tag->hasExhibitions->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $tags->links() }}
        </div>
    </div>
</div>
