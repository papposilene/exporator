@section('title', @ucfirst(__('app.list_of', ['what' => __('app.users')])))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>@ucfirst(__('app.list_of', ['what' => __('app.users')]))</span>
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
                    <a href="{{ route('front.user.index', ['filter' => '']) }}" class="flex flex-auto text-base hover:scale-110 focus:outline-none
                        justify-center px-4 py-2 rounded font-bold cursor-pointer hover:text-black
                        hover:bg-bluegray-300 bg-bluegray-200 hover:border-bluegray-400
                        border duration-200 ease-in-out transition lg:rounded-r-none">
                        <div class="flex leading-5">@ucfirst(__('app.all'))</div>
                    </a>
                    @endauth
                </div>
                <x-forms.input wire:model="search" type="search" class="dark:text-gray-800 dark:bg-bluegray-300 ml-2" :placeholder="@ucfirst(__('app.search'))" />
            </div>
            {{ $users->links() }}
            <div class="py-5">
                <table class="w-full p-5 table-fixed shadow">
                    <thead>
                        <tr class="bg-bluegray-700 dark:bg-gray-900 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-4/12 text-center">@ucfirst(__('app.users'))</th>
                            <th class="w-5/12 text-center">@ucfirst(__('app.roles'))</th>
                            <th class="w-5/12 text-center">@ucfirst(__('app.activities'))</th>
                            <th class="w-5/12 text-center">@ucfirst(__('app.reviews'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr class="bg-bluegray-200 border-b border-bluegray-300 border-dashed h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                <a href="{{ route('front.user.show', ['uuid' => $user->uuid]) }}"
                                    title="{{ $user->name }}" aria-label="{{ $user->name }}">
                                    {{ $user->name }}
                                </a>
                            </td>
                            <td class="text-center">{{ $user->getRoleNames()->first() }}</td>
                            <td class="text-center">{{ $user->hasActivities()->count() }}</td>
                            <td class="text-center">{{ $user->hasReviews()->count() }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $users->links() }}
        </div>
    </div>
</div>
