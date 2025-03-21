<?php

namespace App\Http\Controllers;

class NotificationController extends Controller
{
    public function markAsRead(string $notificationId)
    {
        $user = auth()->user();

        $notification = $user->notifications()->find($notificationId);

        if ($notification && $notification->unread()) {
            $notification->markAsRead();
        }

        return response()->json(['success' => true]);
    }
}
