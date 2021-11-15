@section('title', @ucfirst(__('activity.activity')))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>
                <a href="{{ route('front.activity.index') }}">
                    @ucfirst(__('app.list_of', ['what' => __('app.activities')]))
                </a>
            </span> /
            <span>{{ $activity->id }}</span>
        </h2>
    </x-slot>

    <div class="flex flex-wrap w-full max-w-7xl mx-auto">
        <div class="mx-auto lg:w-1/4 py-5 px-6 lg:px-0 lg:pr-6">
            <ul class="bg-teal-100 md:m-5 mt-5 md:mt-0 p-5 rounded shadow w-full">
                <li class="font-semibold text-red-500 text-center text-2xl mb-3">
                    {{ $users->find($activity->causer_id)->getRoleNames()->first() }}
                </li>
                <li class="text-xl font-bold mb-3">
                    <a href="{{ route('front.user.show', ['uuid' => $users->find($activity->causer_id)->uuid]) }}">
                        {{ $users->find($activity->causer_id)->name }}
                    </a>
                </li>
                <li>@datetime($users->find($activity->causer_id)->created_at)</li>
                <li>
                    <ol class="list-inside list-disc w-full">
                        <li>{{ $users->find($activity->causer_id)->followedPlaces()->count() }}</li>
                        <li>{{ $users->find($activity->causer_id)->followedExhibitions()->count() }}</li>
                        <li>{{ $users->find($activity->causer_id)->followedTags()->count() }}</li>
                    </ol>
                </li>
            </ul>
        </div>

        <div class="mx-auto lg:w-3/4 py-5 px-6">
            @if ($errors->any())
            <div class="bg-red-500 border border-red-700 mb-3 p-3 rounded shadow text-white font-bold">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="bg-teal-500 py-5 shadow">

            </div>
        </div>
    </div>
</div>
