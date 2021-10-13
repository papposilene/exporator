<div>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            <span>@ucfirst(__('app.calendar_of', ['name' => __('app.exhibitions')]))</span>
        </h2>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-5 px-6">
            <div id="calendar-container" class="w-full" wire:ignore>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
</div>
