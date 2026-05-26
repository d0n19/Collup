<x-guest-layout>
    <div class="mb-6 text-center">
        <a href="/" class="font-black text-3xl text-indigo-600 tracking-tight">
            CollabUp<span class="text-purple-600">.</span>
        </a>
        <p class="text-gray-500 text-sm mt-2">Create your student developer profile</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-4">
        @csrf

        <div>
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div>
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        </div>

        <hr class="border-gray-100 my-4">

        <div>
            <x-input-label for="headline" :value="__('Headline / Role (e.g. Android Developer)')" />
            <x-text-input id="headline" class="block mt-1 w-full" type="text" name="headline" :value="old('headline')" placeholder="e.g. Frontend Developer / UI UX Designer" />
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div>
                <x-input-label for="telegram" :value="__('Telegram Username')" />
                <x-text-input id="telegram" class="block mt-1 w-full" type="text" name="telegram" :value="old('telegram')" placeholder="e.g. d_maksot" />
            </div>

            <div>
                <x-input-label for="github" :value="__('GitHub Link')" />
                <x-text-input id="github" class="block mt-1 w-full" type="url" name="github" :value="old('github')" placeholder="https://github.com/username" />
            </div>
        </div>

        <div>
            <x-input-label for="skills" :value="__('Skills (Comma separated)')" />
            <x-text-input id="skills" class="block mt-1 w-full" type="text" name="skills" :value="old('skills')" placeholder="e.g. Python, Laravel, Figma, C++" />
        </div>

        <div>
            <x-input-label for="bio" :value="__('Bio / About Me')" />
            <textarea id="bio" name="bio" rows="3" class="block mt-1 w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" placeholder="Tell other students about your project background...">{{ old('bio') }}</textarea>
        </div>

        <div class="mt-6 flex flex-col gap-4">
            <x-primary-button class="w-full justify-center" style="background-color: #4f46e5 !important; padding: 12px !important;">
                {{ __('Register Account') }}
            </x-primary-button>

            <div class="text-center">
                <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md" href="{{ route('login') }}">
                    {{ __('Already registered? Log in') }}
                </a>
            </div>
        </div>
    </form>
</x-guest-layout>