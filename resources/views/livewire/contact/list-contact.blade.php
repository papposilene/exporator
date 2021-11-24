@section('title', @ucfirst(__('app.list_of', ['what' => __('app.contacts')])))

<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-bluegray-800 dark:text-bluegray-100 leading-tight">
            <span>@ucfirst(__('app.list_of', ['what' => __('app.contacts')]))</span>
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 px-6">
            @if ($errors->any())
            <div class="bg-red-500 border border-red-700 mb-3 p-3 rounded shadow text-white font-bold">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Navigation and search -->
            <div class="relative flex items-center justify-between mb-2 w-full">
                <div class="flex flex-wrap">
                </div>
                <x-forms.input wire:model="search" type="search" class="ml-2" :placeholder="@ucfirst(__('app.search'))" />
            </div>
            <!-- End of navigation and search -->

            @if ($contacts->count() > 0)

            <!-- Pagination -->
            {{ $contacts->links() }}
            <!-- End of pagination -->

            <!-- Users -->
            <div class="py-5">
                <table class="w-full p-5 table-fixed shadow">
                    <thead>
                        <tr class="bg-bluegray-700 dark:bg-gray-900 text-white">
                            <th class="w-1/12 text-center p-3">@ucfirst(__('app.iteration'))</th>
                            <th class="w-4/12 text-center">@ucfirst(__('app.created_at'))</th>
                            <th class="w-5/12 text-center">@ucfirst(__('app.names'))</th>
                            <th class="w-5/12 text-center">@ucfirst(__('app.messages'))</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($contacts as $contact)
                        <tr class="bg-bluegray-200 border-b border-bluegray-300 border-dashed h-12 w-12 p-4">
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">@date(contact->created_at)</td>
                            <td>
                                <a href="{{ route('front.contact.show', ['uuid' => $contact->uuid]) }}">
                                    {{ $contact->name }}
                                </a>
                            </td>
                            <td>{{ $contact->name }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- End of users -->

            <!-- Pagination -->
            {{ $contacts->links() }}
            <!-- End of pagination -->

            @else
            <!-- No data to show -->
            <div class="flex justify-center bg-bluegray-500 text-white p-5 rounded shadow w-full">
                <p class="text-center py-10">
                    @ucfirst(__('app.nothing'))
                </p>
            </div>
            <!-- End of no data to show -->
            @endif
        </div>
    </div>
</div>
