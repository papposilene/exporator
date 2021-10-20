<div>
    <form method="POST" action="{{ route('admin.tag.store') }}" class="flex flex-col w-full">
        @csrf

        <div class="grid grid-cols-1 gap-4 mt-2 md:grid-cols-2 md:mt-4">
            <x-forms.input id="tag" class="block mt-1 w-full" type="text" name="tag" required :placeholder="@ucfirst(__('app.tag'))" :value="old('tag')" />
            <x-forms.button class="block mt-1 w-full">
                @ucfirst(__('app.save'))
            </x-forms.button>
        </div>
    </form>
</div>
