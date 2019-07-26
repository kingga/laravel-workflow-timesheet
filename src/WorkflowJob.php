<?php

/**
 * This file contains the model for the jobs.
 *
 * @author Isaac Skelton
 * @since 1.0.0
 * @package Kingga\LaravelWorkflow
 */

namespace Kingga\LaravelWorkflowTimesheet;

use Illuminate\Database\Eloquent\Model;
use Kingga\LaravelWorkflowTimesheet\WorkflowTask;

/**
 * The model for the jobs.
 */
class WorkflowJob extends Model
{
    /**
     * The columns which can be mass assigned.
     * 
     * @var array
     */
    protected $fillable = [
        'job_id',
        'user_id',
        'name',
        'client',
    ];

    /**
     * Get all tasks which are attached to this job.
     *
     * @return HasMany
     */
    public function tasks()
    {
        return $this->hasMany(WorkflowTask::class, 'job_id');
    }
}
