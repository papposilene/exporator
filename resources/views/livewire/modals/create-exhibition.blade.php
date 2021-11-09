<div id="modalCreateExhibition" class="relative float-right mr-2">
    <div id="modalButtonCreateExhibition">
        <button id="modalOpenCreateExhibition" class="focus:outline-none bg-sky-300 text-black bg-opacity-75 px-1 rounded"
            type="button" title="@ucfirst(__('app.create_one', ['what' => __('app.exhibition')]))">
            @ucfirst(__('app.create_one', ['what' => __('app.exhibition')]))
        </button>
    </div>

    <div id="modalWindowCreateExhibition"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-bluegray-900 bg-opacity-50 transform scale-0 transition-transform duration-300 z-1000">
        <!-- Modal -->
        <div class="bg-white dark:bg-gray-700 dark:text-white overflow-auto w-1/2 h-1/2 p-12">
            <!-- Close modal button-->
            <button id="modalCloseCreateExhibition" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <h5 class="text-xl text-bold">
                @ucfirst(__('app.create_one', ['what' => __('app.exhibition')]))
            </h5>
            <!-- Modal content -->
            <form method="POST" action="{{ route('admin.exhibition.store') }}" enctype="multipart/form-data"
                class="flex flex-col w-full">
                @csrf

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="place">@ucfirst(__('app.place'))</x-forms.label>
                    <x-forms.input id="place" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" required value="{{ $place->name }}" disabled />
                    <x-forms.input type="hidden" name="place" value="{{ $place->uuid }}" />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="title">@ucfirst(__('app.title'))</x-forms.label>
                    <x-forms.input id="title" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="title" :placeholder="@ucfirst(__('app.title'))" required />
                </div>

                <div class="grid grid-cols-2 gap-x-4 mt-4">
                    <x-forms.label class="dark:text-gray-100" for="began_at">@ucfirst(__('app.began_at'))</x-forms.label>
                    <x-forms.label class="dark:text-gray-100" for="ended_at">@ucfirst(__('app.ended_at'))</x-forms.label>
                    <x-forms.input id="began_at" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="began_at" :placeholder="@ucfirst(__('app.ddmmyyyy'))" required />
                    <x-forms.input id="ended_at" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="ended_at" :placeholder="@ucfirst(__('app.ddmmyyyy'))" required />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="description">@ucfirst(__('app.description'))</x-forms.label>
                    <x-forms.textarea id="description" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="description" :placeholder="@ucfirst(__('app.loremipsum'))" required />
                </div>

                <div class="mt-4">
                    <x-forms.label class="dark:text-gray-100" for="link">@ucfirst(__('app.link'))</x-forms.label>
                    <x-forms.input id="link" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="link" placeholder="{{ __('app.https') }}" />
                </div>

                <div class="grid grid-cols-2 gap-x-4 mt-4">
                    <x-forms.label class="dark:text-gray-100" for="price">@ucfirst(__('app.price'))</x-forms.label>
                    <x-forms.label class="dark:text-gray-100" for="public">@ucfirst(__('app.is_published'))</x-forms.label>
                    <x-forms.input id="price" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="price" placeholder="{{ __('app.price') }}" required />
                    <x-forms.select id="public" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" name="is_published" required>
                        <option value="1" selected>@ucfirst(__('app.public'))</option>
                        <option value="0" selected>@ucfirst(__('app.private'))</option>
                    </x-forms.select>
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
    const modalOpenCreateExhibition = document.getElementById('modalOpenCreateExhibition')
    const modalCloseCreateExhibition = document.getElementById('modalCloseCreateExhibition')
    const modalWindowCreateExhibition = document.getElementById('modalWindowCreateExhibition')

    modalOpenCreateExhibition.addEventListener('click',()=>modalWindowCreateExhibition.classList.remove('scale-0'))
    modalCloseCreateExhibition.addEventListener('click',()=>modalWindowCreateExhibition.classList.add('scale-0'))
})
</script>
