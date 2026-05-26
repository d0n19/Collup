<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Create New Project</h2>
    </x-slot>

    <div class="max-w-3xl mx-auto bg-white p-8 rounded-lg shadow-sm">
        <form action="{{ route('projects.store') }}" method="POST" x-data="{ 
            roles: [{ name: '', count: 1 }],
            addRole() { this.roles.push({ name: '', count: 1 }) },
            removeRole(index) { this.roles.splice(index, 1) }
        }">
            @csrf
            
            <div class="space-y-6">
                <div>
                    <label class="block text-sm font-medium text-gray-700">Project Title</label>
                    <input type="text" name="title" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" placeholder="e.g. AI-powered Task Manager">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Category</label>
                    <select name="category_id" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Tech Stack (comma separated)</label>
                    <input type="text" name="tech_stack" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" placeholder="PHP, Laravel, Vue.js, Tailwind">
                </div>

                <div>
                    <label class="block text-sm font-medium text-gray-700">Project Description</label>
                    <textarea name="description" rows="5" required class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500" placeholder="Describe the mission, the goal, and what you've built so far..."></textarea>
                </div>

                <div class="border-t pt-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-bold">Needed Roles</h3>
                        <button type="button" @click="addRole" class="text-sm bg-gray-100 px-3 py-1 rounded-md hover:bg-gray-200">+ Add Role</button>
                    </div>

                    <template x-for="(role, index) in roles" :key="index">
                        <div class="flex gap-4 mb-4 items-end">
                            <div class="flex-1">
                                <label class="block text-xs text-gray-500 mb-1">Role Name (e.g. Backend Developer)</label>
                                <input type="text" :name="`roles[${index}][name]`" required class="w-full border-gray-300 rounded-md shadow-sm" x-model="role.name">
                            </div>
                            <div class="w-24">
                                <label class="block text-xs text-gray-500 mb-1">Spots</label>
                                <input type="number" :name="`roles[${index}][count]`" required min="1" class="w-full border-gray-300 rounded-md shadow-sm" x-model="role.count">
                            </div>
                            <button type="button" @click="removeRole(index)" class="mb-2 text-red-500 font-bold" x-show="roles.length > 1">&times;</button>
                        </div>
                    </template>
                </div>

                <div class="pt-6">
                    <button type="submit" class="w-full bg-indigo-600 text-white px-6 py-3 rounded-md font-bold hover:bg-indigo-700 transition">Publish Project</button>
                </div>
            </div>
        </form>
    </div>
</x-app-layout>
