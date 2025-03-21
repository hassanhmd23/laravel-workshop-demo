<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string comment
 * @property Carbon created_at
 * @property Carbon updated_at
 * @property User user
 * @property Task task
 */
class TaskComment extends Model
{
    protected $fillable = [
        'comment',
        'user_id',
        'task_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function task(): BelongsTo
    {
        return $this->belongsTo(Task::class);
    }
}
