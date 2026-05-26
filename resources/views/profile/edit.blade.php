<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Account Settings') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            
            <div class="p-6 bg-white rounded-xl shadow-sm border border-gray-100">
                <h3 class="text-lg font-bold text-gray-900 mb-4">Profile Information</h3>
                <form method="POST" action="{{ route('profile.update') }}" class="space-y-6">
                    @csrf
                    @method('patch')

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="name" :value="__('Name')" />
                            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $user->name)" required autofocus autocomplete="name" />
                            <x-input-error class="mt-2" :messages="$errors->get('name')" />
                        </div>

                        <div>
                            <x-input-label for="email" :value="__('Email')" />
                            <x-text-input id="email" name="email" type="email" class="mt-1 block w-full" :value="old('email', $user->email)" required autocomplete="username" />
                            <x-input-error class="mt-2" :messages="$errors->get('email')" />
                        </div>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <x-input-label for="telegram" :value="__('Telegram Username')" />
                            <x-text-input id="telegram" name="telegram" type="text" class="mt-1 block w-full" :value="old('telegram', $user->telegram)" placeholder="e.g. janesmith" />
                        </div>

                        <div>
                            <x-input-label for="github" :value="__('GitHub Profile Link')" />
                            <x-text-input id="github" name="github" type="url" class="mt-1 block w-full" :value="old('github', $user->github)" placeholder="https://github.com/username" />
                        </div>
                    </div>

                    <div>
                        <x-input-label for="headline" :value="__('Professional Headline / Role')" />
                        <x-text-input id="headline" name="headline" type="text" class="mt-1 block w-full" :value="old('headline', $user->headline)" placeholder="e.g. Backend Developer / UI UX Designer" />
                    </div>

                    <div>
                        <x-input-label for="skills" :value="__('Skills (Comma separated)')" />
                        <x-text-input id="skills" name="skills" type="text" class="mt-1 block w-full" :value="old('skills', $user->skills)" placeholder="e.g. Laravel, React, Figma, Python" />
                    </div>

                    <div>
                        <x-input-label for="bio" :value="__('Bio / About Me')" />
                        <textarea id="bio" name="bio" rows="4" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" placeholder="Write something about your experiences and interest...">{{ old('bio', $user->bio) }}</textarea>
                    </div>

                    <div class="flex items-center gap-4 pt-2">
                        <button type="submit" style="background-color: #4f46e5 !important; color: white !important; font-weight: 600;" class="px-6 py-2 rounded-md text-sm hover:bg-indigo-700 transition shadow-sm">
                            Save Changes
                        </button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</x-app-layout>