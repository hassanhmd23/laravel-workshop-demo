<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property string name
 * @property string description
 * @property string status
 * @property string priority
 * @property int project_id
 * @property int created_by
 * @property int assigned_to
 * @property Carbon due_date
 * @property Carbon created_at
 * @property Carbon updated_at
 *
 * @property Project project
 * @property User createdBy
 * @property User assignedTo
 * @property TaskComment[] comments
 */
class Task extends Model
{

    protected $fillable = [
        'name',
        'description',
        'status',
        'priority',
        'due_date',
        'project_id',
        'created_by',
        'assigned_to',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function assignedTo(): BelongsTo
    {
        return $this->belongsTo(User::class, 'assigned_to');
    }

    public function comments()
    {
        return $this->hasMany(TaskComment::class);
    }

}
