<x-app-layout>
    <h1 class="text-2xl font-bold mb-6">Edit Task</h1>

    @if($task)

    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
        @csrf
        @method('PUT')

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="title">
                Title
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="title" name="title" type="text" value="{{ $task->title }}" required>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="description">
                Description
            </label>
            <textarea class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                      id="description" name="description" rows="4" required>{{ $task->description }}</textarea>
        </div>

        <div class="mb-4">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="status">
                Status
            </label>
            <select class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                    id="status" name="status" required>
                <option value="pending" {{ $task->status === 'pending' ? 'selected' : '' }}>Pending</option>
                <option value="completed" {{ $task->status === 'completed' ? 'selected' : '' }}>Completed</option>
            </select>
        </div>

        <div class="mb-6">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="due_date">
                Due Date
            </label>
            <input class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" 
                   id="due_date" name="due_date" type="datetime-local" 
                   value="{{ old('due_date', $task->due_date ? \Carbon\Carbon::parse($task->due_date)->format('Y-m-d\TH:i') : '') }}" required>
            <p class="text-xs text-gray-500 mt-1">Select or update the due date and time for the task.</p>
        </div>

        <div class="flex items-center justify-between">
            <button class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline" type="submit">
                Update Task
            </button>
        </div>
    </form>
    @else
        <p class="text-red-500">Task not found</p>
    @endif
</x-app-layout>