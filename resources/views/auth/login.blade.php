<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-logo class="block h-16 w-auto">{{ config('app.name', 'Exporator') }}</x-logo>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        @if (session('status'))
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ session('status') }}
        </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div>
                <x-jet-label for="email" :value="@ucfirst(__('auth.input_email'))" class="dark:text-white" />
                <x-jet-input id="email" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full"
                    type="email" name="email" :value="old('email')" required autofocus />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" :value="@ucfirst(__('auth.input_password'))" class="dark:text-white" />
                <x-jet-input id="password"  class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full"
                    type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-jet-checkbox id="remember_me" name="remember"
                        class="dark:text-gray-800 dark:bg-bluegray-300 block" />
                    <span class="ml-2 text-sm text-bluegray-600 dark:text-white">@ucfirst(__('auth.remember_me'))</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-bluegray-600 dark:text-white hover:text-bluegray-900" href="{{ route('password.request') }}">
                        @ucfirst(__('auth.password_forgot'))
                    </a>
                @endif

                <x-jet-button class="ml-4 bg-bluegray-500">
                    @ucfirst(__('auth.login'))
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
