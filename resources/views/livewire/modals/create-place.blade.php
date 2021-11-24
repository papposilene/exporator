<div id="modalCreatePlace" class="relative float-right mr-2">
    <div id="modalButtonCreatePlace">
        <button id="modalOpenCreatePlace" class="focus:outline-none bg-rose-300 text-black bg-opacity-75 px-1 rounded"
            type="button" title="@ucfirst(__('app.create_one', ['what' => __('app.place')]))">
            @ucfirst(__('app.create_one', ['what' => __('app.place')]))
        </button>
    </div>

    <div id="modalWindowCreatePlace"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-bluegray-900 bg-opacity-50 transform scale-0 transition-transform duration-300 z-1000">
        <!-- Modal -->
        <div class="bg-white dark:bg-gray-700 dark:text-white overflow-auto w-1/2 h-1/2 p-12">
            <!-- Close modal button-->
            <button id="modalCloseCreatePlace" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <h5 class="text-xl text-bold">
                @ucfirst(__('app.create_one', ['what' => __('app.place')]))
            </h5>
            <!-- Modal content -->
            <form method="POST" action="{{ route('admin.place.store') }}" enctype="multipart/form-data"
                class="flex flex-col w-full">
                @csrf

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="name">@ucfirst(__('app.place'))</x-forms.label>
                    <x-forms.input id="name" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="name" required :value="old('name')" />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="type">@ucfirst(__('app.type'))</x-forms.label>
                    <x-forms.select id="type" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" name="type" required>
                        @foreach ($types as $type)
                        <option value="{{ $type->slug }}">@ucfirst(__('app.' . Str::slug($type->type, '_')))</option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="status">@ucfirst(__('app.status'))</x-forms.label>
                    <x-forms.select id="status" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" name="status" required>
                        <option value="1">@ucfirst(__('app.place_open'))</option>
                        <option value="0">@ucfirst(__('app.place_closed'))</option>
                    </x-forms.select>
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="address">@ucfirst(__('app.address'))</x-forms.label>
                    <x-forms.textarea id="address" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="address" required>{{ old('address') }}</x-forms.textarea>
                </div>

                <div class="grid grid-cols-2 gap-x-4 mt-4">
                    <x-forms.label class="dark:text-gray-100" for="city">@ucfirst(__('app.city'))</x-forms.label>
                    <x-forms.label class="dark:text-gray-100" for="country">@ucfirst(__('app.country'))</x-forms.label>
                    <x-forms.input id="city" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="city" required :value="old('city')" />
                    <livewire:interfaces.autocomplete-country />
                </div>

                <div class="grid grid-cols-2 gap-x-4 mt-4">
                    <x-forms.label class="dark:text-gray-100" for="latitude">@ucfirst(__('app.latitude'))</x-forms.label>
                    <x-forms.label class="dark:text-gray-100" for="longitude">@ucfirst(__('app.longitude'))</x-forms.label>
                    <x-forms.input id="latitude" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="latitude" required :value="old('latitude')" />
                    <x-forms.input id="longitude" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="longitude" required :value="old('longitude')" />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="link">@ucfirst(__('app.link'))</x-forms.label>
                    <x-forms.input id="link" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="link" required :value="old('link')" />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="twitter">@ucfirst(__('app.twitter_name'))</x-forms.label>
                    <x-forms.input id="twitter" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="twitter" required :value="old('twitter')" />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="image">@ucfirst(__('app.image'))</x-forms.label>
                    <x-forms.input id="image" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="file" name="image" :value="old('image')" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-forms.button class="ml-4 bg-bluegray-500 p-2">
                        @ucfirst(__('app.save'))
                    </x-forms.button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    const modalOpenCreatePlace = document.getElementById('modalOpenCreatePlace')
    const modalCloseCreatePlace = document.getElementById('modalCloseCreatePlace')
    const modalWindowCreatePlace = document.getElementById('modalWindowCreatePlace')

    modalOpenCreatePlace.addEventListener('click',()=>modalWindowCreatePlace.classList.remove('scale-0'))
    modalCloseCreatePlace.addEventListener('click',()=>modalWindowCreatePlace.classList.add('scale-0'))
})
</script>
