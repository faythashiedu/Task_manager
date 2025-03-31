<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\Models\Task;

class TaskDueReminder extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    protected $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
            ->subject('Task Reminder: ' . $this->task->title)
            ->greeting('Hello ' . $notifiable->name . ',')
            ->line('Your task **' . $this->task->title . '** is almost due.')
            ->line('Due Date: ' . $this->task->due_date->format('F j, Y, g:i A'))
            ->action('View Task', url('/tasks/' . $this->task->id))
            ->line('Make sure to complete it on time!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
