<div>
    <form method="POST" action="{{ route('admin.exhibition.delete') }}" class="flex justify-center w-full">
        @csrf

        <input type="hidden" name="uuid" value="{{ $exhibition->uuid }}" />

        <x-forms.button class="bg-red-600 hover:bg-black dark:hover:bg-white p-2">
            @ucfirst(__('app.delete'))
        </x-forms.button>
    </form>
</div>
