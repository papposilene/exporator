<div id="modalEditTag" class="relative float-right mr-2">
    <div id="modalButtonEditTag">
        <button id="modalOpenEditTag" class="focus:outline-none bg-indigo-300 text-black bg-opacity-75 px-1 rounded"
            type="button" title="@ucfirst(__('app.edit_', ['what' => $tag->name]))">
            @ucfirst(__('app.edit_', ['what' => $tag->name]))
        </button>
    </div>

    <div id="modalWindowEditTag"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-bluegray-900 bg-opacity-50 transform scale-0 transition-transform duration-300 z-1000">
        <!-- Modal -->
        <div class="bg-white dark:bg-bluegray-600 dark:text-white overflow-auto w-1/2 h-1/2 p-12">
            <!-- Close modal button-->
            <button id="modalCloseEditTag" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <!-- Modal content -->
            <form method="POST" action="{{ route('admin.tag.store') }}" enctype="multipart/form-data"
                class="flex flex-col w-full">
                @csrf

                <x-forms.input type="hidden" name="id" value="{{ $tag->id }}" />

                <div class="grid grid-cols-2 gap-x-4 mt-4">
                    <x-forms.label for="type">@ucfirst(__('app.type'))</x-forms.label>
                    <x-forms.label for="name">@ucfirst(__('app.tag'))</x-forms.label>
                    <x-forms.input id="type" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="type" required value="{{ $tag->type }}" />
                    <x-forms.input id="name" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" type="text" name="name" required value="{{ $tag->name }}" />
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
    const modalOpenEditTag = document.getElementById('modalOpenEditTag')
    const modalCloseEditTag = document.getElementById('modalCloseEditTag')
    const modalWindowEditTag = document.getElementById('modalWindowEditTag')

    modalOpenEditTag.addEventListener('click',()=>modalWindowEditTag.classList.remove('scale-0'))
    modalCloseEditTag.addEventListener('click',()=>modalWindowEditTag.classList.add('scale-0'))
})
</script>
