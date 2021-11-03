<button {{ $attributes->merge(['type' => 'button', 'class' => 'inline-flex items-center px-4 py-2 bg-white border border-bluegray-300 rounded-md font-semibold text-xs text-bluegray-700 uppercase tracking-widest shadow-sm hover:text-bluegray-500 focus:outline-none focus:border-sky-300 focus:ring focus:ring-sky-200 active:text-bluegray-800 active:bg-bluegray-50 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
