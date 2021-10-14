<div id="modalCreateTag" class="relative float-right mr-2">
    <div id="modalButtonCreateTag">
        <button id="modalOpenCreateTag" class="focus:outline-none bg-blue-100 text-black bg-opacity-75 px-1 rounded"
            type="button" title="@ucfirst(__('app.create_one', ['what' => __('app.tag')]))">
            @ucfirst(__('app.create_one', ['what' => __('app.tag')]))
        </button>
    </div>

    <div id="modalWindowCreateTag"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300 z-10">
        <!-- Modal -->
        <div class="bg-white overflow-auto w-1/2 h-1/2 p-12">
            <!-- Close modal button-->
            <button id="modalCloseCreateTag" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <!-- Modal content -->
            <form method="POST" action="{{ route('admin.museum.store') }}" enctype="multipart/form-data"
                class="flex flex-col w-full">
                @csrf

                <div class="mt-4">
                    <x-forms.label for="name">@ucfirst(__('app.museum'))</x-forms.label>
                    <x-forms.input id="name" class="block mt-1 w-full" type="text" name="name" required :value="old('name')" />
                </div>

                <div class="mt-4">
                    <x-forms.label for="type">@ucfirst(__('app.type'))</x-forms.label>
                    <x-forms.select id="type" class="block mt-1 w-full" name="type" required>
                        @foreach ($types as $type)
                        <option value="{{ $type->slug }}">@ucfirst($type->type)</option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="mt-4">
                    <x-forms.label for="status">@ucfirst(__('app.status'))</x-forms.label>
                    <x-forms.select id="status" class="block mt-1 w-full" name="status" required>
                        <option value="1">@ucfirst(__('app.museum_open'))</option>
                        <option value="0">@ucfirst(__('app.museum_close'))</option>
                    </x-forms.select>
                </div>

                <div class="mt-4">
                    <x-forms.label for="address">@ucfirst(__('app.address'))</x-forms.label>
                    <x-forms.textarea id="address" class="block mt-1 w-full" type="text" name="address" required>{{ old('address') }}</x-forms.textarea>
                </div>

                <div class="grid grid-cols-2 gap-x-4 mt-4">
                    <x-forms.label for="name">@ucfirst(__('app.city'))</x-forms.label>
                    <x-forms.label for="name">@ucfirst(__('app.country'))</x-forms.label>
                    <x-forms.input id="city" class="block mt-1 w-full" type="text" name="city" required :value="old('city')" />
                    <livewire:country.autocomplete-country />
                </div>

                <div class="grid grid-cols-2 gap-x-4 mt-4">
                    <x-forms.label for="latitude">@ucfirst(__('app.latitude'))</x-forms.label>
                    <x-forms.label for="longitude">@ucfirst(__('app.longitude'))</x-forms.label>
                    <x-forms.input id="latitude" class="block mt-1 w-full" type="text" name="latitude" required :value="old('latitude')" />
                    <x-forms.input id="longitude" class="block mt-1 w-full" type="text" name="longitude" required :value="old('longitude')" />
                </div>

                <div class="mt-4">
                    <x-forms.label for="link">@ucfirst(__('app.link'))</x-forms.label>
                    <x-forms.input id="link" class="block mt-1 w-full" type="text" name="link" required :value="old('link')" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-forms.button class="ml-4">
                        @ucfirst(__('app.save'))
                    </x-forms.button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    const modalOpenCreateTag = document.getElementById('modalOpenCreateTag')
    const modalCloseCreateTag = document.getElementById('modalCloseCreateTag')
    const modalWindowCreateTag = document.getElementById('modalWindowCreateTag')

    modalOpenCreateTag.addEventListener('click',()=>modalWindowCreateTag.classList.remove('scale-0'))
    modalCloseCreateTag.addEventListener('click',()=>modalWindowCreateTag.classList.add('scale-0'))
})
</script>
