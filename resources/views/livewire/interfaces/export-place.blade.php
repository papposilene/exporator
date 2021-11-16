<div class="relative float-right mr-2">
    <form method="POST" action="{{ route('admin.place.export') }}" class="flex flex-col w-full">
        @csrf

        <x-forms.button class="h-6 bg-red-600 hover:bg-black">
            @ucfirst(__('app.export'))
        </x-forms.button>
    </form>
</div>
