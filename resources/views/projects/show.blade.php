<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Project Details</h2>
    </x-slot>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow-sm p-8">
                <div class="mb-6">
                    <h1 class="text-3xl font-bold text-gray-900">{{ $project->title }}</h1>
                    <div class="mt-2 flex items-center space-x-4 text-gray-500">
                        <span>{{ $project->category->name }}</span>
                        <span>&bull;</span>
                        <span>Posted {{ $project->created_at->diffForHumans() }}</span>
                    </div>
                </div>

                <div class="prose max-w-none text-gray-700">
                    <h3 class="text-lg font-bold mb-2">Description</h3>
                    <p>{{ $project->description }}</p>
                </div>

                <div class="mt-8">
                    <h3 class="text-lg font-bold mb-4">Open Roles</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                        @foreach($project->roles as $role)
                            <div class="border rounded-lg p-4 flex justify-between items-center bg-gray-50">
                                <div>
                                    <p class="font-bold text-gray-900">{{ $role->role_name }}</p>
                                    <p class="text-sm text-gray-500">{{ $role->required_count }} spot(s) available</p>
                                </div>
                                <button @click="$dispatch('open-apply-modal', { role_id: {{ $role->id }}, role_name: '{{ $role->role_name }}' })" class="text-indigo-600 font-bold text-sm hover:underline">Apply</button>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white rounded-lg shadow-sm p-6 text-center">
                <img src="https://ui-avatars.com/api/?name={{ urlencode($project->owner->name) }}&size=128" class="w-24 h-24 rounded-full mx-auto mb-4">
                <h3 class="font-bold text-xl">{{ $project->owner->name }}</h3>
                <p class="text-gray-500 mb-4">{{ $project->owner->bio }}</p>
                <div class="flex justify-center space-x-2">
                    <a href="{{ $project->owner->github_url }}" target="_blank" class="text-gray-400 hover:text-gray-900">GitHub</a>
                </div>
            </div>

            <div class="bg-white rounded-lg shadow-sm p-6">
                <h3 class="font-bold mb-4">Tech Stack</h3>
                <div class="flex flex-wrap gap-2">
                    @foreach(explode(',', $project->tech_stack) as $tech)
                        <span class="bg-indigo-50 text-indigo-700 px-3 py-1 rounded-full text-sm">{{ trim($tech) }}</span>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

    <div x-data="{ open: false, roleId: null, roleName: '' }" @open-apply-modal.window="open = true; roleId = $event.detail.role_id; roleName = $event.detail.role_name" class="relative z-50" x-show="open" style="display: none">
        <div class="fixed inset-0 bg-gray-500 bg-opacity-75 transition-opacity"></div>
        <div class="fixed inset-0 z-10 overflow-y-auto">
            <div class="flex min-h-full items-end justify-center p-4 text-center sm:items-center sm:p-0">
                <div class="relative transform overflow-hidden rounded-lg bg-white text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-lg p-6">
                    <h3 class="text-lg font-bold mb-4">Apply for <span x-text="roleName"></span></h3>
                    <form action="{{ route('projects.apply', $project) }}" method="POST">
                        @csrf
                        <input type="hidden" name="project_role_id" :value="roleId">
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Why should we pick you?</label>
                            <textarea name="message" rows="4" class="mt-1 w-full border-gray-300 rounded-md" required placeholder="Describe your experience relevant to this role..."></textarea>
                        </div>
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-gray-700">Relevant Links (Portfolio, Repo)</label>
                            <input type="text" name="experience_links" class="mt-1 w-full border-gray-300 rounded-md" placeholder="https://github.com/...">
                        </div>
                        <div class="flex justify-end space-x-3">
                            <button type="button" @click="open = false" class="bg-gray-200 px-4 py-2 rounded-md">Cancel</button>
                            <button type="submit" class="bg-indigo-600 text-white px-4 py-2 rounded-md">Submit Application</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
