<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\App;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (App::runningInConsole()) {
            $this->app->afterResolving(Schedule::class, function (Schedule $schedule) {
                $schedule->command('task:send-reminders')->daily(); // Runs once a day
            });
        }
    }
}
