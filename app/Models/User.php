<?php

namespace App\Models;

use Database\Factories\UserFactory;
use DateTime;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

/**
 * @property int id
 * @property string name
 * @property string email
 * @property string password
 * @property DateTime|null email_verified_at
 * @property Task[] tasks
 * @property Task[] createdTasks
 * @property Project[] projects
 * @property TaskComment[] comments
 * @property DateTime created_at
 * @property DateTime updated_at
 */
class User extends Authenticatable
{
    /** @use HasFactory<UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function tasks()
    {
        return $this->hasMany(Task::class, 'assigned_to');
    }

    public function createdTasks(): HasMany
    {
        return $this->hasMany(Task::class, 'created_by');
    }

    public function projects()
    {
        return $this->hasMany(Project::class, 'created_by');
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }
}
