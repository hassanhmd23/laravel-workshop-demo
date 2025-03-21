<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Concurrency;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        [$projectsCount, $tasksCount] = Concurrency::run([
            fn() => Project::query()->count(),
            fn() => Task::query()->count(),
        ]);

        return view('dashboard', [
            'projectsCount' => $projectsCount,
            'tasksCount' => $tasksCount,
        ]);
    }
}
