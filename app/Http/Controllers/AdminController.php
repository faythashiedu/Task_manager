<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Models\User;


class AdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function dashboard()
    // {
    //     return view('admin.dashboard', [
    //         // Task Statistics
    //         'totalTasks' => Task::count(),
    //         'completedTasks' => Task::where('status', 'completed')->count(),
    //         'pendingTasks' => Task::where('status', 'pending')->count(),
            
    //         // User Statistics
    //         'totalUsers' => User::count(),
    //         'adminUsers' => User::where('role', 'admin')->count(),
    //         'regularUsers' => User::where('role', 'user')->count(),
            
    //         // Recent Activity
    //         'recentTasks' => Task::with('user')
    //                           ->latest()
    //                           ->limit(5)
    //                           ->get(['id', 'title', 'status', 'created_at'])
    //     ]);
    // }

    {
        return view('admin.dashboard', [
            'totalTasks' => Task::query()->count(),
            'completedTasks' => Task::where('status', 'completed')->count(),
            'pendingTasks' => Task::where('status', 'pending')->count(),
            'totalUsers' => User::count(),
            'adminUsers' => User::where('role', 'admin')->count(),
            'regularUsers' => User::where('role', 'user')->count(),
            'recentTasks' => Task::with(['user:id,name'])
                            ->latest()
                            ->take(5)
                            ->get(['id', 'title', 'status', 'created_at', 'user_id'])
        ]);
    }
}