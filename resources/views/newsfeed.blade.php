<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200">
                <div class="p-6">
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="h-10 w-10 rounded-full bg-indigo-600 flex items-center justify-center text-white font-bold uppercase text-sm">
                            {{ substr(Auth::user()->name, 0, 2) }}
                        </div>
                        <div>
                            <h2 class="text-lg font-bold text-gray-900">Newsfeed</h2>
                            <p class="text-xs text-gray-500">Share your latest updates and thoughts</p>
                        </div>
                    </div>

                    <form action="{{ route('social.newsfeed') }}" method="POST" class="space-y-4">
                        @csrf
                        <div>
                            <textarea 
                                id="content" 
                                name="content" 
                                rows="3" 
                                placeholder="What's on your mind? Share an update or tech insight..." 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-gray-700 p-3 text-sm resize-none"
                                required></textarea>
                        </div>
                        <div class="flex justify-end">
                            <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-indigo-600 border border-transparent rounded-lg font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700 active:bg-indigo-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 shadow-sm">
                                Publish Post
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="space-y-4">
                @forelse($posts as $post)
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 p-6 transition duration-150 hover:shadow-md">
                        <div class="flex items-start space-x-4">
                            <div class="flex-shrink-0">
                                <div class="h-11 w-11 rounded-full bg-gradient-to-br from-indigo-500 to-purple-600 flex items-center justify-center text-white font-bold uppercase text-sm shadow-sm">
                                    {{ substr($post->user->name, 0, 2) }}
                                </div>
                            </div>
                            <div class="flex-1 min-w-0">
                                <div class="flex items-center justify-between">
                                    <p class="text-sm font-bold text-gray-900 truncate">
                                        {{ $post->user->name }}
                                    </p>
                                    <p class="text-xs text-gray-400">
                                        {{ $post->created_at->diffForHumans() }}
                                    </p>
                                </div>
                                <p class="text-xs text-indigo-600 font-medium mb-3">
                                    {{ $post->user->skills ?? 'Community Member' }}
                                </p>
                                <div class="text-sm text-gray-700 whitespace-pre-wrap break-words leading-relaxed">
                                    {{ $post->content }}
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 p-16 text-center">
                        <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-indigo-50 text-indigo-600 mb-4 shadow-sm">
                            <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 20H5a2 2 0 01-2-2V6a2 2 0 012-2h10a2 2 0 012 2v1M19 20a2 2 0 002-2V8a2 2 0 00-2-2h-5a2 2 0 00-2 2v3m2 9v1m0-1c-1.11 0-2.08-.402-2.599-1M21 14a5 5 0 11-10 0 5 5 0 0110 0z" />
                            </svg>
                        </div>
                        <h3 class="text-lg font-bold text-gray-900 mb-1">No updates in the feed yet</h3>
                        <p class="text-sm text-gray-500 max-w-sm mx-auto">
                            Be the first to share an update, project detail, or a technical insight with the community!
                        </p>
                    </div>
                @endforelse
            </div>

        </div>
    </div>
</x-app-layout>