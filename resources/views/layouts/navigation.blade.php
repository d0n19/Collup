<nav x-data="{ open: false }" class="bg-white border-b border-gray-200 shadow-sm">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16">
            <div class="flex">
                <div class="shrink-0 flex items-center">
                    <a href="{{ route('dashboard') }}" class="text-xl font-black text-indigo-600 tracking-tight">
                        CollabUp
                    </a>
                </div>
                <div class="hidden space-x-8 sm:-my-px sm:ms-10 sm:flex">
                    <x-nav-link :href="route('dashboard')" :active="request()->routeIs('dashboard')">
                        Explore Projects
                    </x-nav-link>
                    <x-nav-link :href="route('social.newsfeed')" :active="request()->routeIs('social.newsfeed')">
                        Feed
                    </x-nav-link>
                    <x-nav-link :href="route('social.friends')" :active="request()->routeIs('social.friends')">
                        Friends
                    </x-nav-link>
                    <x-nav-link :href="route('social.chats')" :active="request()->routeIs('social.chats')">
                        Messenger
                    </x-nav-link>
                </div>
            </div>
            <div class="hidden sm:flex sm:items-center sm:ms-6">
                <div class="ms-3 relative">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="text-sm font-semibold text-gray-500 hover:text-gray-700 transition">
                            EXIT
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</nav>