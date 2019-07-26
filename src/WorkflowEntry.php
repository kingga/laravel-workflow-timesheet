<?php

/**
 * This file contains the model for the timesheet entry.
 *
 * @author Isaac Skelton <contact@isaacskelton.com>
 * @since 1.0.0
 * @package Kingga\LaravelWorkflow
 */

namespace Kingga\LaravelWorkflowTimesheet;

use Illuminate\Database\Eloquent\Model;
use Kingga\LaravelWorkflowTimesheet\WorkflowTask;
use Kingga\LaravelWorkflowTimesheet\WorkflowWeek;

/**
 * The timesheet entry model.
 */
class WorkflowEntry extends Model
{
    /**
     * The date columns to cast into Carbon objects.
     *
     * @var array
     */
    protected $dates = [
        'date',
    ];

    /**
     * The columns to cast to the given type.
     *
     * @var array
     */
    protected $casts = [
        'time' => 'float',
    ];

    /**
     * The relationship to the WorkflowWeek model.
     *
     * @return BelongsTo
     */
    public function week()
    {
        return $this->belongsTo(WorkflowWeek::class, 'week_id');
    }

    /**
     * The relationship to the WorkflowTask model.
     *
     * @return BelongsTo
     */
    public function task()
    {
        return $this->belongsTo(WorkflowTask::class, 'task_id');
    }

    /**
     * Return the date as a string rather than a Carbon instance.
     * 
     * @return string The formatted date.
     */
    public function getDateStringAttribute(): string
    {
        return $this->date->format('Y-m-d');
    }
}
