<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 flex h-[600px]">
                <div class="w-1/3 border-r border-gray-200 flex flex-col">
                    <div class="p-4 border-b border-gray-200">
                        <form action="{{ route('social.group_chat.create') }}" method="POST" class="space-y-2">
                            @csrf
                            <input type="text" name="name" placeholder="New Group Chat Name" class="w-full text-xs rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                            <button type="submit" class="w-full py-2 bg-indigo-600 text-white text-xs font-bold uppercase rounded-lg hover:bg-indigo-700 transition">
                                Create Group
                            </button>
                        </form>
                    </div>
                    <div class="flex-1 overflow-y-auto divide-y divide-gray-100">
                        @forelse($rooms as $r)
                            <a href="{{ route('social.chats', $r) }}" class="flex items-center p-4 hover:bg-gray-50 transition {{ $room && $room->id === $r->id ? 'bg-indigo-50' : '' }}">
                                <div class="h-9 w-9 rounded-full bg-indigo-100 text-indigo-700 flex items-center justify-center font-bold uppercase text-xs mr-3">
                                    {{ substr($r->name ?? 'Chat', 0, 2) }}
                                </div>
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm font-bold text-gray-900 truncate">{{ $r->name ?? 'Direct Chat' }}</p>
                                    <p class="text-xs text-gray-500 truncate">{{ $r->messages->last()->message ?? 'No messages yet' }}</p>
                                </div>
                            </a>
                        @empty
                            <p class="p-4 text-xs text-gray-500 text-center">No chat rooms available.</p>
                        @endforelse
                    </div>
                </div>

                <div class="w-2/3 flex flex-col bg-gray-50">
                    @if($room)
                        <div class="p-4 bg-white border-b border-gray-200 font-bold text-gray-900 shadow-sm">
                            {{ $room->name ?? 'Chat Session' }}
                        </div>
                        <div class="flex-1 p-4 overflow-y-auto space-y-4">
                            @foreach($messages as $msg)
                                <div class="flex flex-col {{ $msg->user_id === Auth::id() ? 'items-end' : 'items-start' }}">
                                    <span class="text-[10px] text-gray-400 mb-1 px-1">{{ $msg->user->name }}</span>
                                    <div class="max-w-md px-4 py-2 rounded-xl text-sm shadow-sm {{ $msg->user_id === Auth::id() ? 'bg-indigo-600 text-white' : 'bg-white text-gray-800 border border-gray-200' }}">
                                        {{ $msg->message }}
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        <div class="p-4 bg-white border-t border-gray-200">
                            <form action="{{ route('social.chats', $room) }}" method="POST" class="flex space-x-2">
                                @csrf
                                <input type="hidden" name="chat_room_id" value="{{ $room->id }}">
                                <input type="text" name="message" placeholder="Type a message..." class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-sm" required autocomplete="off">
                                <button type="submit" class="px-6 py-2 bg-indigo-600 text-white text-sm font-bold rounded-lg hover:bg-indigo-700 transition">
                                    Send
                                </button>
                            </form>
                        </div>
                    @else
                        <div class="flex-1 flex flex-col items-center justify-center text-gray-400">
                            <svg class="w-12 h-12 mb-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 12h.01M12 12h.01M16 12h.01M21 12c0 4.418-4.03 8-9 8a9.863 9.863 0 01-4.255-.949L3 20l1.395-3.72C3.512 15.042 3 13.574 3 12c0-4.418 4.03-8 9-8s9 3.582 9 8z" />
                            </svg>
                            <p class="text-sm">Select a chat from the sidebar or create a new group.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>