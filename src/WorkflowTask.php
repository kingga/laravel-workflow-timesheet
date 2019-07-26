<?php

/**
 * This file contains the tasks model.
 *
 * @author Isaac Skelton <contact@isaacskelton.com>
 * @since 1.0.0
 * @package Kingga\LaravelWorkflow
 */

namespace Kingga\LaravelWorkflowTimesheet;

use Illuminate\Database\Eloquent\Model;
use Kingga\LaravelWorkflowTimesheet\WorkflowJob;
use Kingga\LaravelWorkflowTimesheet\WorkflowEntry;

/**
 * The task model.
 */
class WorkflowTask extends Model
{
    /**
     * The columns which can be mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
        'job_id',
        'name',
    ];

    /**
     * Get the job which this task is attached to.
     *
     * @return BelongsTo
     */
    public function job()
    {
        return $this->belongsTo(WorkflowJob::class, 'job_id');
    }

    /**
     * Get the entries which are attached to this task.
     *
     * @return HasMany
     */
    public function entries()
    {
        return $this->hasMany(WorkflowEntry::class, 'task_id');
    }
}
