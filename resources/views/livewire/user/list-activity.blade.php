@section('title', @ucfirst(__('app.list_of', ['what' => __('app.activities')])))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>@ucfirst(__('app.list_of', ['what' => __('app.activities')]))</span>
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
                    <a href="?filter=followed" class="flex flex-auto text-base hover:scale-110 focus:outline-none
                        justify-center px-4 py-2 rounded font-bold cursor-pointer hover:text-black
                        hover:bg-bluegray-300 bg-bluegray-200 hover:border-bluegray-400
                        border duration-200 ease-in-out transition lg:rounded-l-none">
                        <div class="flex leading-5">
                            <svg xmlns="http://www.w3.org/2000/svg" class="text-yellow-500 h-6 w-6" fill="yes" viewBox="0 0 24 24" stroke="currentColor" title="@ucfirst(__('app.followed'))">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M11.049 2.927c.3-.921 1.603-.921 1.902 0l1.519 4.674a1 1 0 00.95.69h4.915c.969 0 1.371 1.24.588 1.81l-3.976 2.888a1 1 0 00-.363 1.118l1.518 4.674c.3.922-.755 1.688-1.538 1.118l-3.976-2.888a1 1 0 00-1.176 0l-3.976 2.888c-.783.57-1.838-.197-1.538-1.118l1.518-4.674a1 1 0 00-.363-1.118l-3.976-2.888c-.784-.57-.38-1.81.588-1.81h4.914a1 1 0 00.951-.69l1.519-4.674z" />
                            </svg>
                        </div>
                    </a>
                    @endauth
                </div>
                <x-forms.input wire:model="search" type="search" class="dark:text-gray-800 dark:bg-bluegray-300 ml-2" :placeholder="@ucfirst(__('app.search'))" />
            </div>
            {{ $activities->links() }}
            <div class="py-5">
                <table class="w-full p-5 table-fixed shadow">
                    <thead>
                        <tr class="bg-bluegray-700 dark:bg-gray-900 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-3/12 text-center">@ucfirst(__('app.users'))</th>
                            <th class="w-1/12 text-center">@ucfirst(__('activity.events'))</th>
                            <th class="w-1/12 text-center">@ucfirst(__('activity.subjects_type'))</th>
                            <th class="w-3/12 text-center">@ucfirst(__('activity.subjects_id'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($activities as $activity)
                        <tr class="bg-bluegray-200 border-b border-bluegray-300 border-dashed h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>
                                @if ($activity->causer_id)
                                <a href="{{ route('front.user.show', ['uuid' => $activity->causer_id]) }}">
                                    {{ $users->find($activity->causer_id)->name }}
                                </a>
                                @else
                                @ucfirst(__('activity.no_subject'))
                                @endif
                            </td>
                            <td class="text-center">{{ $activity->event }}</td>
                            <td>
                                @if ($activity->subject_type === 'App\Models\Country')
                                {{ $users->find($activity->causer_id)->name }}
                                @elseif ($activity->subject_type === 'App\Models\Exhibition')
                                <a href="{{ route('front.exhiibtion.show', ['uuid' => $activity->subject_id]) }}">
                                    {{ $exhiibtions->find($activity->subject_id)->title }}
                                </a>
                                @elseif ($activity->subject_type === 'App\Models\Place')
                                <a href="{{ route('front.place.show', ['uuid' => $activity->causer_id]) }}">
                                    {{ $places->find($activity->subject_id)->name }}
                                </a>
                                @elseif ($activity->subject_type === 'App\Models\Tag')
                                <a href="{{ route('front.tag.show', ['uuid' => $activity->causer_id]) }}">
                                    {{ $tags->find($activity->subject_id)->name }}
                                </a>
                                @elseif ($activity->subject_type === 'App\Models\Type')
                                <a href="{{ route('front.type.show', ['uuid' => $activity->causer_id]) }}">
                                    {{ $types->find($activity->subject_id)->type }}
                                </a>
                                @elseif ($activity->subject_type === 'App\Models\User')
                                <a href="{{ route('front.user.show', ['uuid' => $activity->subject_id]) }}">
                                    {{ $users->find($activity->subject_id)->name }}
                                </a>
                                @elseif ($activity->subject_type === 'App\Models\UserExhibition')
                                <a href="{{ route('front.user.show', ['uuid' => $activity->causer_id]) }}">
                                    {{ $users->find($activity->subject_id)->name }}
                                </a>
                                @elseif ($activity->subject_type === 'App\Models\UserPlace')
                                <a href="{{ route('front.user.show', ['uuid' => $activity->causer_id]) }}">
                                    {{ $users->find($activity->subject_id)->name }}
                                </a>
                                @elseif ($activity->subject_type === 'App\Models\UserReview')
                                <a href="{{ route('front.user.show', ['uuid' => $activity->causer_id]) }}">
                                    {{ $users->find($activity->subject_id)->name }}
                                </a>
                                @elseif ($activity->subject_type === 'App\Models\UserTag')
                                <a href="{{ route('front.user.show', ['uuid' => $activity->causer_id]) }}">
                                    {{ $users->find($activity->subject_id)->name }}
                                </a>
                                @else
                                {{ $activity->subject_id }}
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $activities->links() }}
        </div>
    </div>
</div>
