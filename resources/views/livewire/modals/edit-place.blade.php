<div id="modalEditPlace" class="relative float-right mr-2">
    <div id="modalButtonEditPlace">
        <button id="modalOpenEditPlace" class="focus:outline-none bg-rose-300 text-black bg-opacity-75 px-1 rounded"
            type="button" title="@ucfirst(__('app.edit_', ['what' => $place->name]))">
            @ucfirst(__('app.edit_', ['what' => $place->name]))
        </button>
    </div>

    <div id="modalWindowEditPlace"
        class="invisible fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-bluegray-900 bg-opacity-50 transform scale-0 transition-transform duration-300 z-1000">
        <!-- Modal -->
        <div class="bg-white dark:bg-gray-700 dark:text-white overflow-auto w-1/2 h-1/2 p-12">
            <!-- Close modal button-->
            <button id="modalCloseEditPlace" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <!-- Modal content -->
            <form method="POST" action="{{ route('admin.place.update') }}" enctype="multipart/form-data"
                class="flex flex-col w-full">
                @csrf

                <x-forms.input type="hidden" name="uuid" value="{{ $place->uuid }}" />

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="name">@ucfirst(__('app.place'))</x-forms.label>
                    <x-forms.input id="name" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="name" required value="{{ $place->name }}" />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="slug">@ucfirst(__('app.slug'))</x-forms.label>
                    <x-forms.input id="slug" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="slug" required value="{{ $place->slug }}" />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="type">@ucfirst(__('app.type'))</x-forms.label>
                    <x-forms.select id="type" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" name="type" required>
                        @foreach ($types as $type)
                        <option value="{{ $type->slug }}" {{ ($type->slug === $place->type ? 'selected=true' : '') }}>@ucfirst(__('app.' . Str::slug($type->type, '_')))</option>
                        @endforeach
                    </x-forms.select>
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="status">@ucfirst(__('app.status'))</x-forms.label>
                    <x-forms.select id="status" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" name="status" required>
                        <option value="1" {{ ($place->status === 1 ? 'selected=true' : '') }}>@ucfirst(__('app.place_open'))</option>
                        <option value="0" {{ ($place->status === 0 ? 'selected=true' : '') }}>@ucfirst(__('app.place_closed'))</option>
                    </x-forms.select>
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="address">@ucfirst(__('app.address'))</x-forms.label>
                    <x-forms.textarea id="address" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="address" required>{{ $place->address }}</x-forms.textarea>
                </div>

                <div class="grid grid-cols-2 gap-x-4 mt-4">
                    <x-forms.label class="dark:text-gray-100" for="city">@ucfirst(__('app.city'))</x-forms.label>
                    <x-forms.label class="dark:text-gray-100" for="country">@ucfirst(__('app.country'))</x-forms.label>
                    <x-forms.input id="city" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="city" required value="{{ $place->city }}" />
                    <livewire:interfaces.autocomplete-country />
                </div>

                <div class="grid grid-cols-2 gap-x-4 mt-4">
                    <x-forms.label class="dark:text-gray-100" for="latitude">@ucfirst(__('app.latitude'))</x-forms.label>
                    <x-forms.label class="dark:text-gray-100" for="longitude">@ucfirst(__('app.longitude'))</x-forms.label>
                    <x-forms.input id="latitude" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="latitude" required value="{{ $place->lat }}" />
                    <x-forms.input id="longitude" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="longitude" required value="{{ $place->lon }}" />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="link">@ucfirst(__('app.link'))</x-forms.label>
                    <x-forms.input id="link" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="link" required value="{{ $place->link }}" />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="twitter">@ucfirst(__('app.twitter_name'))</x-forms.label>
                    <x-forms.input id="twitter" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="twitter" required value="{{ $place->twitter }}" />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="image">@ucfirst(__('app.image'))</x-forms.label>
                    <x-forms.input id="image" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="file" name="image" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-forms.button class="ml-4 bg-bluegray-500 p-2">
                        @ucfirst(__('app.save'))
                    </x-forms.button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            const modalOpenEditPlace = document.getElementById('modalOpenEditPlace')
            const modalCloseEditPlace = document.getElementById('modalCloseEditPlace')
            const modalWindowEditPlace = document.getElementById('modalWindowEditPlace')

            modalOpenEditPlace.addEventListener('click',()=>modalWindowEditPlace.classList.remove('invisible'))
            modalCloseEditPlace.addEventListener('click',()=>modalWindowEditPlace.classList.add('invisible'))
        })
    </script>
</div>
