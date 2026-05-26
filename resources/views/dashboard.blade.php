<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">News Feed</h2>
    </x-slot>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="md:col-span-2 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">Latest Opportunities</h3>
                @foreach($latestProjects as $project)
                    <div class="border-b py-4 last:border-0">
                        <div class="flex justify-between items-start">
                            <div>
                                <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 font-semibold hover:underline">{{ $project->title }}</a>
                                <p class="text-sm text-gray-500">Posted by {{ $project->owner->name }} in {{ $project->category->name }}</p>
                            </div>
                            <span class="px-2 py-1 bg-green-100 text-green-800 text-xs rounded-full">New</span>
                        </div>
                        <p class="mt-2 text-gray-600 line-clamp-2">{{ $project->description }}</p>
                    </div>
                @endforeach
            </div>
        </div>

        <div class="space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold mb-4">New Members</h3>
                @foreach($newMembers as $member)
                    <div class="flex items-center space-x-3 mb-4">
                        <img src="https://ui-avatars.com/api/?name={{ urlencode($member->name) }}" class="w-10 h-10 rounded-full">
                        <div>
                            <p class="font-medium text-gray-900">{{ $member->name }}</p>
                            <form action="{{ route('friends.add', $member) }}" method="POST">
                                @csrf
                                <button class="text-xs text-indigo-600 hover:underline">Add Friend</button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="bg-indigo-600 rounded-lg p-6 text-white">
                <h3 class="font-bold text-lg mb-2">Go Premium!</h3>
                <p class="text-sm opacity-90 mb-4">Get unlimited project posts and featured status on search results.</p>
                <button class="bg-white text-indigo-600 px-4 py-2 rounded-md font-bold text-sm">Upgrade Now</button>
            </div>
        </div>
    </div>
</x-app-layout>
