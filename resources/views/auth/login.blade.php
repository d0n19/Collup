<x-guest-layout>
    <div class="mb-8 text-center">
        <a href="/" class="font-black text-3xl text-indigo-600 tracking-tight">
            CollabUp<span class="text-purple-600">.</span>
        </a>
        <p class="text-gray-500 text-sm mt-2">Log in to your student account</p>
    </div>

    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="block mt-4">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
            </label>
        </div>

        <div class="mt-6 flex flex-col gap-4">
            <x-primary-button class="w-full justify-center" style="background-color: #4f46e5 !important; padding: 12px !important;">
                {{ __('Log in') }}
            </x-primary-button>

            <div class="text-center">
                <p class="text-sm text-gray-600">
                    Don't have an account? 
                    <a href="{{ route('register') }}" class="text-indigo-600 font-bold hover:underline">Register</a>
                </p>
            </div>
        </div>
    </form>
</x-guest-layout>   