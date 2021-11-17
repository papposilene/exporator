<div>
    <div class="flex space-x-8 text-bluegray-500 dark:text-gray-300 text-sm justify-end w-full">
        <div><livewire:modals.show-contact /></div>
        <div><a href="{{ route('front.about') }}" class="hover:text-red-600 dark:hover:text-red-400">@ucfirst(__('app.about'))</a></div>
        <div>&copy; 2021-{{ date('Y') }} {{ config('app.name', 'Exporator') }}.</div>
    </div>
</div>
