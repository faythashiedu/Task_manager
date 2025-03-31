<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="p-6 text-gray-900">
        <h3 class="text-2xl font-bold">Welcome back, {{ Auth::user()->name }}! 🎉</h3>
        <p class="text-gray-600 mt-2">Here's what's happening today.</p>
    </div>
    <div class="mt-6 p-6 flex space-x-4">
        <a href="{{ route('tasks.create') }}" class="px-4 py-2 bg-blue-500 text-white rounded-lg">+ New Task</a>
        <a href="{{ route('tasks.index') }}" class="px-4 py-2 bg-green-500 text-white rounded-lg">📋 View All Tasks</a>
        <a href="{{ route('profile.edit') }}" class="px-4 py-2 bg-gray-500 text-white rounded-lg">Edit Profile</a>
    </div>
</x-app-layout>
