<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\TaskCommentController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware' => 'auth'], function () {
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

    Route::resource('tasks', TaskController::class);
    Route::resource('projects', ProjectController::class);
    Route::resource('users', UserController::class);
    Route::resource('comments', TaskCommentController::class)->only(['store']);

    Route::post('notifications/{notificationId}/mark-as-read', [NotificationController::class, 'markAsRead'])->name('notifications.mark-as-read');
});

Route::group(['middleware' => 'guest', 'controller' => AuthController::class, 'prefix' => 'login'], function () {
    Route::get('/', 'login')->name('login');
    Route::post('/', 'authenticate')->name('authenticate');
});
