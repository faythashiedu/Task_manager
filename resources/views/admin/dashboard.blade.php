<x-app-layout>
    <x-slot:title>Admin Dashboard</x-slot>

    <div class="container mx-auto px-4 py-6">
        <!-- Stats Grid -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <!-- Task Stats -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center space-x-4">
                    <svg class="w-10 h-10 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M4 6h16M4 12h16m-7 6h7"></path>
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold">Total Tasks</h3>
                        <p class="text-2xl font-bold">{{ $totalTasks }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-green-100 p-6 rounded-lg shadow-md">
                <div class="flex items-center space-x-4">
                    <svg class="w-10 h-10 text-green-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M5 13l4 4L19 7"></path>
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold">Completed</h3>
                        <p class="text-2xl font-bold">{{ $completedTasks }}</p>
                    </div>
                </div>
            </div>

            <div class="bg-yellow-100 p-6 rounded-lg shadow-md">
                <div class="flex items-center space-x-4">
                    <svg class="w-10 h-10 text-yellow-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path d="M12 8v4l3 3"></path>
                    </svg>
                    <div>
                        <h3 class="text-lg font-semibold">Pending</h3>
                        <p class="text-2xl font-bold">{{ $pendingTasks }}</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Users Summary -->
        <div class="bg-white p-6 rounded-lg shadow-md mb-8">
            <h2 class="text-lg font-semibold mb-4">Users</h2>
            <div class="grid grid-cols-2 gap-4">
                <div class="p-4 bg-gray-100 rounded-lg text-center">
                    <h3 class="text-lg font-medium">Total Users</h3>
                    <p class="text-2xl font-bold">{{ $totalUsers }}</p>
                </div>
                <div class="p-4 bg-gray-100 rounded-lg text-center">
                    <h3 class="text-lg font-medium">Admins</h3>
                    <p class="text-2xl font-bold">{{ $adminUsers }}</p>
                </div>
                <div class="p-4 bg-gray-100 rounded-lg text-center">
                    <h3 class="text-lg font-medium">Regular Users</h3>
                    <p class="text-2xl font-bold">{{ $regularUsers }}</p>
                </div>
            </div>
        </div>

        <!-- Recent Tasks -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-lg font-semibold mb-4">Recent Tasks</h2>
            <table class="w-full border-collapse">
                <thead>
                    <tr class="border-b bg-gray-100">
                        <th class="p-3 text-left">Task</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Created</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($recentTasks as $task)
                    <tr class="border-b">
                        <td class="p-3">
                            <div class="font-medium">{{ $task->title }}</div>
                            <div class="text-sm text-gray-500">{{ $task->user->name }}</div>
                        </td>
                        <td class="p-3">
                            <span class="px-3 py-1 text-sm font-medium rounded-full 
                                {{ $task->status === 'completed' ? 'bg-green-200 text-green-700' : 'bg-yellow-200 text-yellow-700' }}">
                                {{ ucfirst($task->status) }}
                            </span>
                        </td>
                        <td class="p-3">{{ $task->created_at->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
