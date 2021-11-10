@section('title', @ucfirst($type->type))

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
        <div class="mx-auto py-5 px-6 w-full">
            @if ($errors->any())
            <div class="bg-red-500 border border-red-700 mb-3 p-3 rounded shadow text-white font-bold">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="flex sm:flex-row lg:flex-col flex-grow flex-wrap bg-bluegray-500 text-white lg:mr-3 p-5 shadow sm:w-full">
                <p class="mb-3">
                    {{ $activity->id }}
                </p>
                <p class="mb-3">
                    {{ $activity->subject_id }}
                </p>

                {{ dd($users->find($activity->subject_id)) }}

            </div>
        </div>
    </div>
</div>
