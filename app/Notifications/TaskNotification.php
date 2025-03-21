<?php

namespace App\Notifications;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Notification;

class TaskNotification extends Notification implements ShouldBroadcast
{
    use Queueable;

    /**
     * Create a new notification instance.
     */
    public function __construct(
        private readonly Task   $task,
        private readonly string $message
    )
    {
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'message' => $this->message,
            'task_id' => $this->task->id,
        ];
    }

    public function toBroadcast(object $notifiable): BroadcastMessage
    {
        return new BroadcastMessage([
            'message' => $this->message,
            'unreadCount' => $notifiable->unreadNotifications->count(),
            'taskId' => $this->task->id,
        ]);
    }
}
