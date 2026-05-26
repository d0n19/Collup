<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Post a New Project') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white p-6 md:p-8 rounded-xl shadow-sm border border-gray-100">
                
                <form method="POST" action="{{ route('projects.store') }}" class="space-y-6">
                    @csrf

                    <div>
                        <x-input-label for="title" :value="__('Project Title')" />
                        <x-text-input id="title" name="title" type="text" class="mt-1 block w-full" placeholder="e.g. Mobile E-Commerce App Development" required autofocus />
                        <x-input-error class="mt-2" :messages="$errors->get('title')" />
                    </div>

                    <div>
                        <x-input-label for="category_id" :value="__('Project Category')" />
                        <select id="category_id" name="category_id" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm py-2.5" required>
                            <option value="">Select a category</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
                    </div>

                    <div>
                        <x-input-label for="required_skills" :value="__('Required Skills / Roles (Comma separated)')" />
                        <x-text-input id="required_skills" name="required_skills" type="text" class="mt-1 block w-full" placeholder="e.g. Laravel, React, Figma, Python" required />
                        <x-input-error class="mt-2" :messages="$errors->get('required_skills')" />
                    </div>

                    <div>
                        <x-input-label for="description" :value="__('Detailed Project Description')" />
                        <textarea id="description" name="description" rows="6" class="mt-1 block w-full border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm text-sm" placeholder="Describe the goals of the project, technical stack, and who you are looking for..." required></textarea>
                        <x-input-error class="mt-2" :messages="$errors->get('description')" />
                    </div>

                    <div class="flex items-center justify-end gap-4 border-t border-gray-50 pt-4">
                        <a href="{{ route('dashboard') }}" class="text-sm text-gray-600 hover:text-gray-900 font-medium">Cancel</a>
                        <button type="submit" style="background-color: #10b981 !important; color: white !important; font-weight: 700;" class="px-6 py-2.5 rounded-md text-sm hover:bg-emerald-600 transition shadow-sm">
                            Publish Post
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>