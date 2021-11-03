<div class="relative float-right mr-2">
    <form method="POST" action="{{ route('admin.tag.delete') }}" class="flex flex-col w-full">
        @csrf

        <input type="hidden" name="id" value="{{ $tag->id }}" />

        <x-forms.button class="h-6 bg-red-600 hover:bg-black">
            @ucfirst(__('app.delete'))
        </x-forms.button>
    </form>
</div>
