<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use App\Models\Project;
use App\Models\Task;
use App\Models\User;
use App\Notifications\TaskNotification;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $projectId = $request->input('project');
        $assignedTo = $request->input('assigned_to');

        $query = Task::query()->with(['project', 'assignedTo']);

        if ($projectId) {
            $query->where('project_id', $projectId);
        }

        if ($assignedTo) {
            $query->where('assigned_to', $assignedTo);
        }

        return view('tasks.index', [
            'projects' => Project::query()->select('id', 'name')->get(),
            'users' => User::query()->select('id', 'name')->get(),
            'tasks' => $query->latest()->paginate(3)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create', [
            'projects' => Project::query()->select('id', 'name')->get(),
            'users' => User::query()->select('id', 'name')->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(TaskRequest $request)
    {
        $task = Task::query()->create([...$request->validated(), 'created_by' => auth()->id()]);

        if ($task->assigned_to) {
            $task->assignedTo->notify(new TaskNotification($task, "You have been assigned a new task: $task->name"));
        }

        return redirect()->route('tasks.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        return view('tasks.show', [
            'task' => $task->load([
                'project',
                'createdBy',
                'assignedTo',
                'comments' => fn(HasMany $query) => $query->latest()
            ])
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Task $task)
    {
        return view('tasks.edit', [
            'task' => $task->load('project', 'assignedTo'),
            'users' => User::query()->select('id', 'name')->get(),
            'projects' => Project::query()->select('id', 'name')->get()
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(TaskRequest $request, Task $task)
    {
        $old_assigned_to = $task->assigned_to;
        $task->update($request->validated());

        if ($task->assigned_to && $task->assigned_to !== $old_assigned_to) {
            $task->assignedTo->notify(new TaskNotification($task, "You have been assigned a new task: $task->name"));
        }

        return redirect()->route('tasks.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Task $task)
    {
        $task->delete();

        return redirect()->route('tasks.index');
    }
}
