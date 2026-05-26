<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Project Management</h2>
    </x-slot>

    <div class="space-y-12">
        <div>
            <h3 class="text-2xl font-bold mb-6">Projects You're Leading</h3>
            <div class="space-y-6">
                @forelse($projects as $project)
                    <div class="bg-white rounded-lg shadow-sm p-6">
                        <div class="flex justify-between items-start mb-6">
                            <div>
                                <h4 class="text-xl font-bold">{{ $project->title }}</h4>
                                <p class="text-gray-500">{{ $project->category->name }} &bull; {{ $project->status }}</p>
                            </div>
                            <a href="{{ route('projects.show', $project) }}" class="text-indigo-600 hover:underline">View Public Page</a>
                        </div>

                        <div class="border-t pt-4">
                            <h5 class="font-bold text-sm uppercase text-gray-400 mb-4 tracking-widest">Applications</h5>
                            <div class="space-y-4">
                                @forelse($project->applications as $app)
                                    <div class="flex items-center justify-between bg-gray-50 p-4 rounded-lg">
                                        <div class="flex items-center space-x-4">
                                            <img src="https://ui-avatars.com/api/?name={{ urlencode($app->user->name) }}" class="w-10 h-10 rounded-full">
                                            <div>
                                                <p class="font-bold">{{ $app->user->name }} <span class="text-xs font-normal text-gray-500">applied for {{ $app->role->role_name }}</span></p>
                                                <p class="text-sm text-gray-600 italic">"{{ $app->message }}"</p>
                                            </div>
                                        </div>
                                        <div class="flex items-center space-x-2">
                                            @if($app->status === 'pending')
                                                <form action="{{ route('applications.handle', [$app, 'accepted']) }}" method="POST">
                                                    @csrf
                                                    <button class="bg-green-600 text-white px-3 py-1 rounded text-sm">Accept</button>
                                                </form>
                                                <form action="{{ route('applications.handle', [$app, 'rejected']) }}" method="POST">
                                                    @csrf
                                                    <button class="bg-red-600 text-white px-3 py-1 rounded text-sm">Reject</button>
                                                </form>
                                            @else
                                                <span class="px-3 py-1 rounded text-sm font-bold uppercase {{ $app->status === 'accepted' ? 'text-green-600 bg-green-50' : 'text-red-600 bg-red-50' }}">
                                                    {{ $app->status }}
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500">No applications yet.</p>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white p-8 text-center rounded-lg shadow-sm">
                        <p class="text-gray-500 mb-4">You haven't posted any projects yet.</p>
                        <a href="{{ route('projects.create') }}" class="text-indigo-600 font-bold">Post your first project &rarr;</a>
                    </div>
                @endforelse
            </div>
        </div>
        
        <div>
            <h3 class="text-2xl font-bold mb-6">Your Applications</h3>
            <div class="bg-white rounded-lg shadow-sm overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Project</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Applied</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($applications as $app)
                            <tr>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <a href="{{ route('projects.show', $app->project) }}" class="text-indigo-600 font-medium">{{ $app->project->title }}</a>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $app->role->role_name }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <span class="px-2 py-1 text-xs font-bold rounded-full {{ $app->status === 'accepted' ? 'bg-green-100 text-green-800' : ($app->status === 'pending' ? 'bg-yellow-100 text-yellow-800' : 'bg-red-100 text-red-800') }}">
                                        {{ ucfirst($app->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">{{ $app->created_at->format('M d, Y') }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-8 text-center text-gray-500">You haven't applied to any projects yet.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
