<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">Friend Requests</h2>
                <div class="space-y-3">
                    @forelse($pendingRequests as $request)
                        <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg border border-gray-100">
                            <div class="flex items-center space-x-3">
                                <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold uppercase text-sm">
                                    {{ substr($request->name, 0, 2) }}
                                </div>
                                <div>
                                    <p class="text-sm font-bold text-gray-900">{{ $request->name }}</p>
                                    <p class="text-xs text-gray-500">{{ $request->skills ?? 'Developer' }}</p>
                                </div>
                            </div>
                            <form action="{{ route('social.friends.accept', $request) }}" method="POST">
                                @csrf
                                <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-xs font-bold uppercase rounded-lg hover:bg-indigo-700 transition">
                                    Accept
                                </button>
                            </form>
                        </div>
                    @empty
                        <p class="text-sm text-gray-500 text-center py-4">No pending friend requests.</p>
                    @endforelse
                </div>
            </div>

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 p-6">
                <h2 class="text-xl font-bold text-gray-900 mb-4">My Friends</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    @forelse($friends as $friend)
                        <div class="flex items-center space-x-3 p-4 bg-gray-50 rounded-lg border border-gray-100">
                            <div class="h-10 w-10 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold uppercase text-sm">
                                {{ substr($friend->name, 0, 2) }}
                            </div>
                            <div>
                                <p class="text-sm font-bold text-gray-900">{{ $friend->name }}</p>
                                <p class="text-xs text-gray-500">{{ $friend->skills ?? 'Connected' }}</p>
                            </div>
                        </div>
                    @empty
                        <div class="col-span-2 text-center py-8 text-gray-500 text-sm">
                            You haven't added any friends yet.
                        </div>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</x-app-layout>