<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center w-full">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Active Projects & Hackathons') }}
            </h2>
            <a href="{{ route('projects.create') }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                Create Project
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if($projects->isEmpty())
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6 text-center text-gray-500">
                    No projects found. Be the first to create one!
                </div>
            @else
                <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                    @foreach($projects as $project)
                        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg flex flex-col justify-between">
                            <div>
                                @if($project->image_path)
                                    <img src="{{ asset('storage/' . $project->image_path) }}" alt="Project Image" class="w-full h-48 object-cover">
                                @endif
                                <div class="p-6">
                                    <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium bg-indigo-100 text-indigo-800 mb-2">
                                        {{ $project->category->name }}
                                    </span>
                                    <h3 class="text-lg font-bold text-gray-900 mb-2">{{ $project->title }}</h3>
                                    <p class="text-gray-600 text-sm line-clamp-3 mb-4">{{ $project->description }}</p>
                                </div>
                            </div>
                            <div class="p-6 pt-0 border-t border-gray-100 flex justify-between items-center mt-auto">
                                <span class="text-xs text-gray-500">By {{ $project->user->name }}</span>
                                <a href="{{ route('projects.show', $project) }}" class="text-sm font-semibold text-indigo-600 hover:text-indigo-900">
                                    View Details &rarr;
                                </a>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif
        </div>
    </div>
</x-app-layout>