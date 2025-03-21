<?php

namespace App\View\Components;

use App\Models\Project;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ProjectForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string   $action,
        public bool     $isEdit = false,
        public ?Project $project = null
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.project-form');
    }
}
