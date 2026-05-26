<x-app-layout>
    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-6">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl border border-gray-200 p-6 flex justify-between items-center">
                <div>
                    <h2 class="text-xl font-bold text-gray-900">{{ $project->title }} Workspace</h2>
                    <p class="text-xs text-gray-500">Manage project tasks and track collaboration progress</p>
                </div>
                <form action="{{ route('tasks.store', $project) }}" method="POST" class="flex space-x-2">
                    @csrf
                    <input type="text" name="title" placeholder="Task summary..." class="rounded-lg border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 text-xs" required>
                    <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-xs font-bold uppercase rounded-lg hover:bg-indigo-700 transition">
                        Add Task
                    </button>
                </form>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b pb-2 flex items-center justify-between">
                        <span>To Do</span>
                        <span class="bg-gray-100 text-gray-700 text-xs px-2 py-0.5 rounded-full">{{ $tasks->where('status', 'todo')->count() }}</span>
                    </h3>
                    <div class="space-y-3">
                        @foreach($tasks->where('status', 'todo') as $task)
                            <div class="p-4 bg-gray-50 border border-gray-200 rounded-lg shadow-sm">
                                <p class="text-sm text-gray-800 font-medium mb-3">{{ $task->title }}</p>
                                <form action="{{ route('tasks.update', $task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="doing">
                                    <button type="submit" class="w-full py-1 text-center bg-white border border-gray-300 rounded-md text-xs font-semibold text-gray-700 hover:bg-gray-50 transition">
                                        Start Task &rarr;
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b pb-2 flex items-center justify-between">
                        <span>In Progress</span>
                        <span class="bg-amber-100 text-amber-800 text-xs px-2 py-0.5 rounded-full">{{ $tasks->where('status', 'doing')->count() }}</span>
                    </h3>
                    <div class="space-y-3">
                        @foreach($tasks->where('status', 'doing') as $task)
                            <div class="p-4 bg-amber-50/50 border border-amber-100 rounded-lg shadow-sm">
                                <p class="text-sm text-gray-800 font-medium mb-3">{{ $task->title }}</p>
                                <form action="{{ route('tasks.update', $task) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <input type="hidden" name="status" value="done">
                                    <button type="submit" class="w-full py-1 text-center bg-indigo-600 rounded-md text-xs font-semibold text-white hover:bg-indigo-700 transition">
                                        Complete &checkmark;
                                    </button>
                                </form>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-sm border border-gray-200 p-4">
                    <h3 class="text-sm font-bold text-gray-900 uppercase tracking-wider mb-4 border-b pb-2 flex items-center justify-between">
                        <span>Done</span>
                        <span class="bg-emerald-100 text-emerald-800 text-xs px-2 py-0.5 rounded-full">{{ $tasks->where('status', 'done')->count() }}</span>
                    </h3>
                    <div class="space-y-3">
                        @foreach($tasks->where('status', 'done') as $task)
                            <div class="p-4 bg-emerald-50/30 border border-emerald-100 rounded-lg shadow-sm line-through text-gray-500">
                                <p class="text-sm font-medium">{{ $task->title }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>