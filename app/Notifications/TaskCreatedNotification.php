<?php


namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TaskCreatedNotification extends Notification
{
    use Queueable;

    public $task;

    public function __construct($task)
    {
        $this->task = $task;
    }

    public function via($notifiable)
    {
        return ['mail', 'database']; // or just ['database'] if no email needed
    }

    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('New Task Created')
            ->line('A new task has been added.')
            ->line('Task: ' . $this->task->name)
            ->line('Description: ' . $this->task->description);
    }

    public function toArray($notifiable)
    {
        return [
            'task_id' => $this->task->id,
            'task_name' => $this->task->name,
            'description' => $this->task->description,
            'created_at' => $this->task->created_at->toDateTimeString(),
        ];
    }
}
