<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-logo class="block h-16 w-auto">{{ config('app.name', 'Exporator') }}</x-logo>
        </x-slot>

        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-jet-label for="name" :value="@ucfirst(__('auth.input_name'))" class="dark:text-white" />
                <x-jet-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" />
            </div>

            <div class="mt-4">
                <x-jet-label for="email" :value="@ucfirst(__('auth.input_email'))" class="dark:text-white" />
                <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password" :value="@ucfirst(__('auth.input_password'))" class="dark:text-white" />
                <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" />
            </div>

            <div class="mt-4">
                <x-jet-label for="password_confirmation" :value="@ucfirst(__('auth.input_confirm'))" class="dark:text-white" />
                <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1 w-full" />
            </div>

            @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                <div class="mt-4">
                    <x-jet-label for="terms">
                        <div class="flex items-center">
                            <x-jet-checkbox name="terms" id="terms" class="dark:text-gray-800 dark:bg-bluegray-300 block mt-1"/>
                            <div class="ml-2 dark:text-white">
                                {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                        'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-bluegray-600 dark:text-white hover:text-red-400">'.__('Terms of Service').'</a>',
                                        'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-bluegray-600 dark:text-white hover:text-red-400">'.__('Privacy Policy').'</a>',
                                ]) !!}
                            </div>
                        </div>
                    </x-jet-label>
                </div>
            @endif

            <div class="flex items-center justify-end mt-4">
                <a class="underline text-sm text-bluegray-600 dark:text-white hover:text-bluegray-900" href="{{ route('login') }}">
                    @ucfirst(__('auth.already_registered'))
                </a>

                <x-jet-button class="ml-4 bg-bluegray-500">
                    @ucfirst(__('auth.register'))
                </x-jet-button>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>
