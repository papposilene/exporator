<div id="modalImportMuseum" class="relative float-right mr-2">
    <div id="modalButtonImportMuseum">
        <button id="modalOpenImportMuseum" class="focus:outline-none bg-blue-400 text-white bg-opacity-75 rounded"
            type="button" title="@ucfirst(__('app.import_some', ['what' => __('app.museums')]))">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 13h6m-3-3v6m5 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
            </svg>
        </button>
    </div>

    <div id="modalWindowImportMuseum"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <!-- Modal -->
        <div class="bg-white w-1/2 h-1/2 p-12">
            <!-- Close modal button-->
            <button id="modalCloseImportMuseum" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <!-- Modal content -->
            <form method="POST" action="{{ route('admin.museum.import') }}" enctype="multipart/form-data"
                class="flex w-full">
                @csrf

                <div>
                    <x-jet-label for="file" value="@ucfirst(__('app.file'))" />
                    <x-jet-input id="file" class="block mt-1 w-full" type="file" name="file" required autofocus />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-jet-button class="ml-4">
                        @ucfirst(__('app.import'))
                    </x-jet-button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
document.addEventListener('livewire:load', function () {
    const modalOpenImportMuseum = document.getElementById('modalOpenImportMuseum')
    const modalCloseImportMuseum = document.getElementById('modalCloseImportMuseum')
    const modalWindowImportMuseum = document.getElementById('modalWindowImportMuseum')

    modalOpenImportMuseum.addEventListener('click',()=>modalWindowImportMuseum.classList.remove('scale-0'))
    modalCloseImportMuseum.addEventListener('click',()=>modalWindowImportMuseum.classList.add('scale-0'))
})
</script>
