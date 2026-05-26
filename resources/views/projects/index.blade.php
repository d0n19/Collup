<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Find Projects</h2>
            <a href="{{ route('projects.create') }}" class="bg-indigo-600 text-white px-4 py-2 rounded-md hover:bg-indigo-700 transition">Post a Project</a>
        </div>
    </x-slot>

    <div class="mb-8 bg-white p-6 rounded-lg shadow-sm">
        <form action="{{ route('projects.index') }}" method="GET" class="flex flex-wrap gap-4">
            <div class="flex-1 min-w-[200px]">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search skills, stack, titles..." class="w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
            </div>
            <select name="category" class="border-gray-300 rounded-md shadow-sm focus:ring-indigo-500">
                <option value="">All Categories</option>
                @foreach($categories as $category)
                    <option value="{{ $category->slug }}" {{ request('category') == $category->slug ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-gray-800 text-white px-6 py-2 rounded-md hover:bg-gray-900">Filter</button>
        </form>
    </div>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($projects as $project)
            <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden hover:shadow-md transition">
                <div class="p-6">
                    <div class="flex justify-between items-start mb-4">
                        <span class="text-xs font-bold uppercase tracking-wider text-indigo-600 bg-indigo-50 px-2 py-1 rounded">{{ $project->category->name }}</span>
                        @if($project->is_featured)
                            <span class="text-xs font-bold uppercase tracking-wider text-yellow-600 bg-yellow-50 px-2 py-1 rounded">Featured</span>
                        @endif
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $project->description }}</p>
                    
                    <div class="mb-4">
                        <div class="flex flex-wrap gap-2">
                            @foreach(explode(',', $project->tech_stack) as $tech)
                                <span class="bg-gray-100 text-gray-700 px-2 py-1 rounded text-xs">{{ trim($tech) }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="flex items-center justify-between mt-6 pt-4 border-t border-gray-100">
                        <div class="flex items-center space-x-2">
                            <img src="https://ui-avatars.com/api/?name={{ urlencode($project->owner->name) }}" class="w-6 h-6 rounded-full">
                            <span class="text-sm text-gray-600">{{ $project->owner->name }}</span>
                        </div>
                        <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 font-bold hover:text-indigo-800">Details &rarr;</a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-span-full py-12 text-center text-gray-500">
                No projects found matching your criteria.
            </div>
        @endforelse
    </div>

    <div class="mt-8">
        {{ $projects->links() }}
    </div>
</x-app-layout>
