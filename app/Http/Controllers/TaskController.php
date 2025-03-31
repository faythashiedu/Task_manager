<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // For Admins: Show all tasks
        if (auth()->user()->role === 'admin') {
            $tasks = Task::latest()->get();
        }
        // For Regular Users: Show only their tasks
        else {
            $tasks = auth()->user()->tasks()->latest()->get();
        }
        return view('tasks.index', ['tasks' => $tasks]);

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'due_date' => 'nullable|date|after:today',
        ]);
    
        // Create and save the task
        auth()->user()->tasks()->create($validated);
    
        return redirect()->route('tasks.index')->with('success', 'Task created!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Ensure the user owns the task (or is admin)
        if (auth()->user()->role !== 'admin' && $task->user_id !== auth()->id()) {
            abort(403, 'Unauthorized');
        }
        return view('tasks.show', ['task' => $task]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        // Authorization
        if (auth()->user()->role === 'admin') {
            return view('tasks.edit', compact('task'));
        }
    
        // Regular user can only edit their own tasks
        if ($task->user_id === auth()->id()) {
            return view('tasks.edit', compact('task'));
        }
    
        abort(403, 'Unauthorized action.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Task $task)
    {
        // Authorization
        if (auth()->user()->role === 'admin' || $task->user_id === auth()->id()) {
            $validated = $request->validate([
                'title' => 'required|string|max:255',
                'description' => 'required|string',
                'status' => 'required|in:pending,completed',
                'due_date' => 'nullable|date|after:today',
            ]);
    
            $task->update($validated);
            return redirect()->route('tasks.index')->with('success', 'Task updated!');
        }
    
        // Detailed error message for debugging
        abort(403, sprintf(
            'Unauthorized. User role: %s, Task owner: %d, Current user: %d',
            auth()->user()->role,
            $task->user_id,
            auth()->id()
        ));
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        // Authorization
        if (auth()->user()->role === 'admin') {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted!');
        }
    
        // Regular user can only delete their own tasks
        if ($task->user_id === auth()->id()) {
            $task->delete();
            return redirect()->route('tasks.index')->with('success', 'Task deleted!');
        }
    
        abort(403, 'Unauthorized action.');
    }
}
