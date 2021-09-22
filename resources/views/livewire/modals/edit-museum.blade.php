<div id="modalEditMuseum">
    <div id="modalButtonEditMuseum">
        <button id="modalOpenEditMuseum" class="focus:outline-none bg-indigo-200 text-black bg-opacity-75 p-2 rounded w-full"
            type="button" title="@ucfirst(__('app.import_some', ['what' => __('app.museums')]))">
            @ucfirst(__('app.edit_the', ['what' => __('app.museum')]))
        </button>
    </div>

    <div id="modalWindowEditMuseum"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <!-- Modal -->
        <div class="bg-white overflow-auto w-1/2 h-1/2 p-12">
            <!-- Close modal button-->
            <button id="modalCloseEditMuseum" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <!-- Modal content -->
            <form method="POST" action="{{ route('admin.museum.update') }}" enctype="multipart/form-data"
                class="flex flex-col w-full">
                @csrf

                <div class="mt-4">
                    <x-forms.label for="name">@ucfirst(__('app.museum'))</x-forms.label>
                    <x-forms.input id="name" class="block mt-1 w-full" type="text" name="name" required value="{{ $museum->name }}" />
                </div>

                <div class="mt-4">
                    <x-forms.label for="status">@ucfirst(__('app.status'))</x-forms.label>
                    <x-forms.select id="status" class="block mt-1 w-full" name="status" required />
                        <option value="true">@ucfisrt(__('app.museum_open'))</option>
                        <option value="true">@ucfisrt(__('app.museum_close'))</option>
                    </x-forms.select>
                </div>

                <div class="mt-4">
                    <x-forms.label for="address">@ucfirst(__('app.address'))</x-forms.label>
                    <x-forms.textarea id="address" class="block mt-1 w-full" type="text" name="address" required>{{ $museum->address }}</x-forms.textarea>
                </div>

                <div class="grid grid-cols-2 gap-x-4 mt-4">
                    <x-forms.label for="name">@ucfirst(__('app.city'))</x-forms.label>
                    <x-forms.label for="name">@ucfirst(__('app.country'))</x-forms.label>
                    <x-forms.input id="city" class="block mt-1 w-full" type="text" name="city" required value="{{ $museum->city }}" />

                    <x-forms.input id="country" class="block mt-1 w-full" type="text" name="country" required value="{{ $museum->inCountry->name_common_fra }}" />
                </div>

                <div class="mt-4">
                    <x-forms.label for="link">@ucfirst(__('app.link'))</x-forms.label>
                    <x-forms.input id="link" class="block mt-1 w-full" type="text" name="link" required value="{{ $museum->link }}" />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-forms.button class="ml-4">
                        @ucfirst(__('app.import'))
                    </x-forms.button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    const modalOpenEditMuseum = document.getElementById('modalOpenEditMuseum')
    const modalCloseEditMuseum = document.getElementById('modalCloseEditMuseum')
    const modalWindowEditMuseum = document.getElementById('modalWindowEditMuseum')

    modalOpenEditMuseum.addEventListener('click',()=>modalWindowEditMuseum.classList.remove('scale-0'))
    modalCloseEditMuseum.addEventListener('click',()=>modalWindowEditMuseum.classList.add('scale-0'))
})
</script>
