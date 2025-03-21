<?php

namespace App\Models;

use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property int id
 * @property string name
 * @property string description
 * @property DateTime created_at
 * @property DateTime updated_at
 * @property User createdBy
 * @property Task[] tasks
 */
class Project extends Model
{
    protected $fillable = [
        'name',
        'description',
        'created_by'
    ];

    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
