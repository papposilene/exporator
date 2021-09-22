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
                    <x-jet-label for="name" value="{{ __('app.museum') }}" />
                    <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" required  wire:model="museum.name" />
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
    const modalOpenEditMuseum = document.getElementById('modalOpenEditMuseum')
    const modalCloseEditMuseum = document.getElementById('modalCloseEditMuseum')
    const modalWindowEditMuseum = document.getElementById('modalWindowEditMuseum')

    modalOpenEditMuseum.addEventListener('click',()=>modalWindowEditMuseum.classList.remove('scale-0'))
    modalCloseEditMuseum.addEventListener('click',()=>modalWindowEditMuseum.classList.add('scale-0'))
})
</script>
