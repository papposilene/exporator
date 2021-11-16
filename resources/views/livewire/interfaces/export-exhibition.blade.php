<div class="relative float-right mr-2">
    <form method="POST" action="{{ route('admin.exhibition.export') }}" class="flex flex-col w-full">
        @csrf

        <x-forms.button class="focus:outline-none bg-sky-300 text-black bg-opacity-75 h-6 px-1 rounded">
            @ucfirst(__('app.export'))
        </x-forms.button>
    </form>
</div>
