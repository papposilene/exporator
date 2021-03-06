<div id="modalImportPlace" class="relative float-right mr-2">
    <div id="modalButtonImportPlace">
        <button id="modalOpenImportPlace" class="focus:outline-none bg-rose-300 text-black bg-opacity-75 px-1 rounded"
            type="button" title="@ucfirst(__('app.import_some', ['what' => __('app.places')]))">
            @ucfirst(__('app.import'))
        </button>
    </div>

    <div id="modalWindowImportPlace"
        class="invisible fixed top-0 left-0 w-screen h-screen flex items-center justify-center bg-bluegray-900 bg-opacity-50 transform scale-0 transition-transform duration-300 z-1000">
        <!-- Modal -->
        <div class="bg-white dark:bg-gray-700 dark:text-white overflow-auto w-1/2 h-1/2 p-12">
            <!-- Close modal button-->
            <button id="modalCloseImportPlace" type="button" class="focus:outline-none float-right">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                    stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 14l2-2m0 0l2-2m-2 2l-2-2m2 2l2 2m7-2a9 9 0 11-18 0 9 9 0 0118 0z" />
                </svg>
            </button>
            <h5 class="text-xl text-bold">
                @ucfirst(__('app.import'))
            </h5>
            <!-- Modal content -->
            <form method="POST" action="{{ route('admin.place.import') }}" enctype="multipart/form-data"
                class="flex flex-col w-full">
                @csrf

                <div class="flex mb-5 mt-4">
                    <table class="table-auto w-full">
                        <caption class="grid-cols-2 mb-2 p-2">
                            <span class="bg-green-200 dark:text-black mr-2 p-2">@ucfirst(__('app.optional'))</span>
                            <span class="bg-red-200 dark:text-black ml-2 p-2">@ucfirst(__('app.mandatory'))</span>
                        </caption>
                        <thead>
                            <tr class="bg-bluegray-700 dark:bg-gray-900 text-white">
                                <th class="p-3">@ucfirst(__('app.columns'))</th>
                                <th>@ucfirst(__('app.details'))</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.optional'))">
                                <td class="bg-green-200 font-bold text-center dark:text-black">slug</td>
                                <td class="p-2">@ucfirst(__('app.slug'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center dark:text-black">name</td>
                                <td class="p-2">@ucfirst(__('app.name'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center dark:text-black">type</td>
                                <td class="p-2">@ucfirst(__('app.type'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center dark:text-black">status</td>
                                <td class="p-2">@ucfirst(__('app.is_open'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center dark:text-black">address</td>
                                <td class="p-2">@ucfirst(__('app.address'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center dark:text-black">city</td>
                                <td class="p-2">@ucfirst(__('app.city'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center dark:text-black">country</td>
                                <td class="p-2"><a href="https://fr.wikipedia.org/wiki/ISO_3166-1" target="_blank" rel="noopener">@ucfirst(__('app.cca3'))</a></td>
                            </tr>
                            <tr>
                                <td class="bg-red-200 font-bold text-center dark:text-black">latitude</td>
                                <td class="p-2" rowspan="2">@ucfirst(__('app.geolocalisation'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.mandatory'))">
                                <td class="bg-red-200 font-bold text-center dark:text-black">longitude</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.optional'))">
                                <td class="bg-green-200 font-bold text-center dark:text-black">link</td>
                                <td class="p-2">@ucfirst(__('app.link'))</td>
                            </tr>
                            <tr class="border-b border-black border-dashed"
                                title="@ucfirst(__('app.optional'))">
                                <td class="bg-green-200 font-bold text-center dark:text-black">twitter</td>
                                <td class="p-2">@ucfirst(__('app.twitter_name'))</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

                <div class="flex items-center">
                    <x-forms.input id="file" class="block mt-1 w-full" type="file" name="datafile" required />
                </div>

                <div class="flex items-center justify-end mt-4">
                    <x-forms.button class="ml-4 bg-bluegray-500 p-2">
                        @ucfirst(__('app.import'))
                    </x-forms.button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('livewire:load', function () {
            const modalOpenImportPlace = document.getElementById('modalOpenImportPlace')
            const modalCloseImportPlace = document.getElementById('modalCloseImportPlace')
            const modalWindowImportPlace = document.getElementById('modalWindowImportPlace')

            modalOpenImportPlace.addEventListener('click',()=>modalWindowImportPlace.classList.remove('invisible'))
            modalCloseImportPlace.addEventListener('click',()=>modalWindowImportPlace.classList.add('invisible'))
        })
    </script>
</div>
