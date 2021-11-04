<div>
    <form method="POST" action="{{ route('admin.exhibition.publish') }}" class="flex justify-center w-full">
        @csrf

        <input type="hidden" name="uuid" value="{{ $exhibition->uuid }}" />

        <x-forms.button class="bg-red-600 hover:bg-black">
            @ucfirst(__('app.publish_', ['what' => $exhibition->title]))
        </x-forms.button>
    </form>
</div>
