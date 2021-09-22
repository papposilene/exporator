<div id="modalCreateMuseum" class="relative float-right mr-2">
    <div id="modalButtonCreateMuseum">
        <button id="modalOpenCreateMuseum" class="focus:outline-none bg-blue-400 text-white bg-opacity-75 rounded"
            type="button" title="@ucfirst(__('app.create_one', ['what' => __('app.museum')]))">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
        </button>
    </div>

    <div id="modalWindowCreateMuseum"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <!-- Modal -->
        <div class="bg-white overflow-auto w-1/2 h-1/2 p-12">
            <!-- Close modal button-->
            <button id="modalCloseCreateMuseum" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <!-- Modal content -->
            <form method="POST" action="{{ route('login') }}" class="flex w-full">
                @csrf

                <div>
                    <x-forms.label for="file" value="@ucfirst(__('app.file'))" />
                    <x-forms.input id="file" class="block mt-1 w-full" type="file" name="file" required autofocus />
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
    const modalOpenCreateMuseum = document.getElementById('modalOpenCreateMuseum')
    const modalCloseCreateMuseum = document.getElementById('modalCloseCreateMuseum')
    const modalWindowCreateMuseum = document.getElementById('modalWindowCreateMuseum')

    modalOpenCreateMuseum.addEventListener('click',()=>modalWindowCreateMuseum.classList.remove('scale-0'))
    modalCloseCreateMuseum.addEventListener('click',()=>modalWindowCreateMuseum.classList.add('scale-0'))
})
</script>
