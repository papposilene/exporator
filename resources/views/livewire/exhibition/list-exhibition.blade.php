<div>
    <x-slot name="header">
        @if (Auth::user()->can('create', App\Models\Exhibition::class))
        <livewire:modals.import-exhibition />
        @endif
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>@ucfirst(__('app.list_of', ['name' => __('app.exhibitions')]))</span>
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
                <x-forms.select wire:model="sort" class="relative float-right h-9 ml-2 mb-3">
                    <option value="past">Past</option>
                    <option value="current">Current</option>
                    <option value="future">Future</option>
                </x-forms.select>
                {{ $exhibitions->links() }}
            </div>
            <div class="py-5">
                <table class="w-full p-5 table-fixed">
                    <thead>
                        <tr class="bg-gray-700 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-3/12 text-center">@ucfirst(__('app.museums'))</th>
                            <th class="w-4/12 text-center">@ucfirst(__('app.titles'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.began_at'))</th>
                            <th class="w-2/12 text-center">@ucfirst(__('app.ended_at'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($exhibitions as $exhibition)
                        @php
                        $today = date('Y-m-d');

                        if ($today > $exhibition->began_at && $today < $exhibition->ended_at) {
                            // Current exhibition
                            $is_current = 'bg-green-100';
                        }
                        elseif ($today > $exhibition->ended_at) {
                            // Past exhibition
                            $is_current = 'bg-red-100';
                        }
                        elseif ($today < $exhibition->began_at) {
                            // Future exhibition
                            $is_current = 'bg-blue-100';
                        }
                        else {
                            $is_current = 'bg-gray-100';
                        }
                        @endphp
                        <tr class="border-b border-gray-300 border-dashed h-12 w-12 p-4 {{ $is_current }}">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('admin.museum.show', ['slug' => $exhibition->inMuseum->slug]) }}"
                                    title="{{ $exhibition->inMuseum->name }}" aria-label="{{ $exhibition->inMuseum->name }}">
                                    {{ $exhibition->inMuseum->name }}
                                </a>
                            </td>
                            <td>
                                <a href="{{ route('admin.exhibition.show', ['museum' => $exhibition->inMuseum->slug, 'exhibition' => $exhibition->slug]) }}"
                                    title="{{ $exhibition->title }}" aria-label="{{ $exhibition->title }}">
                                    {{ $exhibition->title }}
                                </a>
                            </td>
                            <td class="text-center">@date($exhibition->began_at)</td>
                            <td class="text-center">@date($exhibition->ended_at)</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $exhibitions->links() }}
        </div>
    </div>
</div>
