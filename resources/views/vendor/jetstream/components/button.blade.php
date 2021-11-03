<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-bluegray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-bluegray-700 active:bg-bluegray-900 focus:outline-none focus:border-bluegray-900 focus:ring focus:ring-bluegray-300 disabled:opacity-25 transition']) }}>
    {{ $slot }}
</button>
