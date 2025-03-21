<?php

namespace App\View\Components;

use App\Models\User;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UserForm extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public string $action,
        public bool   $isEdit = false,
        public ?User  $user = null
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.user-form');
    }
}
