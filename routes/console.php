<?php

use Illuminate\Foundation\Console\ClosureCommand;
use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Models\Task;
use App\Notifications\TaskDueReminder;
use Illuminate\Support\Facades\Schedule;

Schedule::call(function () {
    $tasks = Task::whereNotNull('due_date')
        ->where('due_date', '>=', now()) // Due in the future
        ->where('due_date', '<=', now()->addDay()) // Due in the next 24 hours
        ->get();

    foreach ($tasks as $task) {
        $task->user->notify(new TaskDueReminder($task));
    }
})->hourly();

Artisan::command('inspire', function () {
    /** @var ClosureCommand $this */
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');
