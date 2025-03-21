<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskCommentRequest;
use App\Models\TaskComment;
use App\Notifications\TaskNotification;

class TaskCommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskCommentRequest $request)
    {
        $taskComment = TaskComment::query()->create([...$request->validated(), 'user_id' => auth()->id()]);

        $task = $taskComment->task;

        $task->assignedTo->notify(new TaskNotification($task, "A new comment has been added to the task: $task->name"));

        return redirect()->back();
    }
}
