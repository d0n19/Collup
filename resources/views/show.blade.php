    <x-app-layout>
        <div class="py-12 bg-gray-50 min-h-screen">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                    
                    <div class="md:col-span-1 space-y-4">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200">
                            <h2 class="text-lg font-bold text-gray-900 mb-4 border-b pb-2">Your Chats</h2>
                            <div class="space-y-2">
                                @foreach($rooms as $r)
                                    <a href="/chats/{{ $r->id }}" 
                                    class="block p-3 rounded-lg text-sm font-medium transition {{ request()->is('chats/'.$r->id) ? 'bg-indigo-50 text-indigo-700' : 'text-gray-700 hover:bg-gray-50' }}">
                                        {{ $r->name }}
                                    </a>
                                @endforeach
                            </div>
                            
                            <div class="mt-6 pt-4 border-t border-gray-200">
                                <form action="/chats" method="POST" class="space-y-2">
                                    @csrf
                                    <input type="text" name="name" placeholder="New chat name..." class="w-full rounded-md border-gray-300 text-sm shadow-sm" required>
                                    <button type="submit" class="w-full py-2 bg-indigo-600 text-white text-xs font-bold uppercase rounded-lg hover:bg-indigo-700 transition">Create Chat</button>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="md:col-span-3">
                        <div class="bg-white p-6 rounded-xl shadow-sm border border-gray-200 flex flex-col h-[600px]">
                            <h2 class="text-xl font-bold text-gray-900 mb-4 border-b pb-2">{{ $room->name }}</h2>
                            
                            <div class="flex-1 overflow-y-auto space-y-4 mb-4 pr-2">
                                @forelse($messages as $message)
                                    <div class="p-4 bg-gray-50 rounded-lg border border-gray-100">
                                        <p class="text-sm text-gray-800">{{ $message->content }}</p>
                                        <span class="text-[10px] text-gray-400 mt-1 block">{{ $message->created_at->format('H:i') }}</span>
                                    </div>
                                @empty
                                    <p class="text-sm text-gray-500 italic">No messages yet. Start the conversation!</p>
                                @endforelse
                            </div>

                            <form action="/chats/{{ $room->id }}/messages" method="POST" class="flex space-x-2 border-t pt-4">
                                @csrf
                                <input type="text" name="content" placeholder="Type your message..." class="flex-1 rounded-md border-gray-300 text-sm shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                                <button type="submit" class="px-6 py-2 bg-emerald-600 text-white text-sm font-bold rounded-md hover:bg-emerald-700 transition">Send</button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <form action="{{ route('projects.apply', $project) }}" method="POST">
    @csrf

    <input type="hidden" name="project_role_id" value="{{ $project->roles->first()->id ?? '' }}">

    <button type="submit" class="px-4 py-2 bg-blue-600 text-white rounded">
        Apply
    </button>
</form>
    </x-app-layout>