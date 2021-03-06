<div>
    <form method="POST" action="{{ route('admin.tag.attach') }}" class="flex flex-col w-full">
        @csrf

        <input type="hidden" name="uuid" value="{{ $exhibition->uuid }}" />

        <div class="grid grid-cols-1 gap-4 mt-2 lg:grid-cols-2 lg:mt-4">
            <livewire:interfaces.autocomplete-tag />
            <x-forms.button class="block bg-bluegray-500 mt-1 justify-center w-full">
                @ucfirst(__('app.save'))
            </x-forms.button>
        </div>
    </form>
</div>
