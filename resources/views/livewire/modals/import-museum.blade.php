<div id="modalImportMuseum" class="relative float-right mr-2">
    <div id="modalButtonImportMuseum">
        <button id="modalOpenImportMuseum" class="focus:outline-none bg-purple-100 text-black bg-opacity-75 px-1 rounded"
            type="button" title="@ucfirst(__('app.import_some', ['what' => __('app.museums')]))">
            @ucfirst(__('app.import'))
        </button>
    </div>

    <div id="modalWindowImportMuseum"
        class="fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-blue-500 bg-opacity-50 transform scale-0 transition-transform duration-300">
        <!-- Modal -->
        <div class="bg-white overflow-auto w-1/2 h-1/2 p-12">
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
                class="flex flex-col w-full">
                @csrf

                <div class="flex mb-5">
                    <table class="table-auto w-full">
                        <caption class="grid-cols-2 mb-2 p-2">
                            <span class="bg-green-200 mr-2 p-2">@ucfirst(__('app.optional'))</span>
                            <span class="bg-red-200 ml-2 p-2">@ucfirst(__('app.mandatory'))</span>
                        </caption>
                        <thead>
                            <tr>
                                <th>@ucfirst(__('app.columns'))</th>
                                <th>@ucfirst(__('app.details'))</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.optional'))">
                                <td class="bg-green-200 font-bold text-center">slug</td>
                                <td class="p-2">@ucfirst(__('app.slug'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">name</td>
                                <td class="p-2">@ucfirst(__('app.name'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">type</td>
                                <td class="p-2">@ucfirst(__('app.type'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">status</td>
                                <td class="p-2">@ucfirst(__('app.is_open'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">address</td>
                                <td class="p-2">@ucfirst(__('app.address'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">city</td>
                                <td class="p-2">@ucfirst(__('app.city'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">country</td>
                                <td class="p-2"><a href="https://fr.wikipedia.org/wiki/ISO_3166-1" target="_blank" rel="noopener">@ucfirst(__('app.cca3'))</a></td>
                            </tr>
                            <tr>
                                <td class="bg-red-200 font-bold text-center">latitude</td>
                                <td class="p-2" rowspan="2">@ucfirst(__('app.geolocalisation'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center">longitude</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.optional'))">
                                <td class="bg-green-200 font-bold text-center">link</td>
                                <td class="p-2">@ucfirst(__('app.link'))</td>
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
    const modalOpenImportMuseum = document.getElementById('modalOpenImportMuseum')
    const modalCloseImportMuseum = document.getElementById('modalCloseImportMuseum')
    const modalWindowImportMuseum = document.getElementById('modalWindowImportMuseum')

    modalOpenImportMuseum.addEventListener('click',()=>modalWindowImportMuseum.classList.remove('scale-0'))
    modalCloseImportMuseum.addEventListener('click',()=>modalWindowImportMuseum.classList.add('scale-0'))
})
</script>
