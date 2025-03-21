<?php

namespace App\View\Components;

use App\Models\Task;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class TaskForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string     $action,
        public Collection $projects,
        public Collection $users,
        public bool       $isEdit = false,
        public ?Task      $task = null,
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.task-form');
    }
}
