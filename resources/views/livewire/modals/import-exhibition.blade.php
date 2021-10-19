<div id="modalImportExhibition" class="relative float-right">
    <div id="modalButtonImportExhibition">
        <button id="modalOpenImportExhibition" class="focus:outline-none bg-pink-100 text-black bg-opacity-75 px-1 rounded"
            type="button" title="@ucfirst(__('app.import_some', ['what' => __('app.museums')]))">
            @ucfirst(__('app.import'))
        </button>
    </div>

    <div id="modalWindowImportExhibition"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300 z-10">
        <!-- Modal -->
        <div class="bg-white overflow-auto w-1/2 h-1/2 p-12">
            <!-- Close modal button-->
            <button id="modalCloseImportExhibition" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <!-- Modal content -->
            <form method="POST" action="{{ route('admin.exhibition.import') }}" enctype="multipart/form-data"
                class="overflow-auto flex flex-col w-full">
                @csrf

                <div class="flex mb-5">
                    <table class="table-auto w-full">
                        <caption class="grid-cols-2 mb-2 p-2">
                            <span class="bg-green-200 mr-2 p-2">@ucfirst(__('app.optional'))</span>
                            <span class="bg-red-200 ml-2 p-2">@ucfirst(__('app.mandatory'))</span>
                        </caption>
                        <thead>
                            <tr class="bg-gray-700 text-white">
                                <th class="p-3">@ucfirst(__('app.columns'))</th>
                                <th>@ucfirst(__('app.details'))</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">place</td>
                                <td class="p-2">@ucfirst(__('app.museum'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">title</td>
                                <td class="p-2">@ucfirst(__('app.title'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">began_at</td>
                                <td class="p-2">@ucfirst(__('app.began_at'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">ended_at</td>
                                <td class="p-2">@ucfirst(__('app.ended_at'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">description</td>
                                <td class="p-2">@ucfirst(__('app.description'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.optional'))">
                                <td class="bg-green-200 font-bold text-center">link</td>
                                <td class="p-2">@ucfirst(__('app.link'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.optional'))">
                                <td class="bg-green-200 font-bold text-center">price</td>
                                <td class="p-2">@ucfirst(__('app.price'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.optional'))">
                                <td class="bg-green-200 font-bold text-center">tags</td>
                                <td class="p-2">type1:tag1,type1:tag2,type2,tag:1</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center">
                    <x-forms.input id="file" class="block mt-1 w-full" type="file" name="datafile" required autofocus />
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
    const modalOpenImportExhibition = document.getElementById('modalOpenImportExhibition')
    const modalCloseImportExhibition = document.getElementById('modalCloseImportExhibition')
    const modalWindowImportExhibition = document.getElementById('modalWindowImportExhibition')

    modalOpenImportExhibition.addEventListener('click',()=>modalWindowImportExhibition.classList.remove('scale-0'))
    modalCloseImportExhibition.addEventListener('click',()=>modalWindowImportExhibition.classList.add('scale-0'))
})
</script>
