<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Task;
use Carbon\Carbon;
use App\Notifications\TaskDueReminder;

class SendTaskReminder extends Command
{
    protected $signature = 'task:send-reminders';
    protected $description = 'Send email reminders for tasks that are almost due';

    public function handle()
    {
        // Get tasks that are due in 24 hours
        $tasks = Task::where('due_date', '<=', Carbon::now()->addDay())
                     ->where('due_date', '>', Carbon::now()) // Ensure it's not overdue
                     ->get();

        foreach ($tasks as $task) {
            $task->user->notify(new TaskDueReminder($task));
        }

        $this->info('Task reminders sent successfully.');
    }
}
