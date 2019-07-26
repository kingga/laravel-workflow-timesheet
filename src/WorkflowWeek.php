<?php

/**
 * This file contains the model for the week.
 *
 * @author Isaac Skelton <contact@isaacskelton.com>
 * @since 1.0.0
 * @package Kingga\LaravelWorkflow
 */

namespace Kingga\LaravelWorkflowTimesheet;

use DateTime;
use Kingga\WorkflowTimesheet\Day;
use Illuminate\Support\Facades\DB;
use Kingga\WorkflowTimesheet\Week;
use Kingga\WorkflowTimesheet\Entry;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Kingga\LaravelWorkflowTimesheet\WorkflowJob;
use Kingga\LaravelWorkflowTimesheet\WorkflowTask;
use Kingga\LaravelWorkflowTimesheet\WorkflowWeek;
use Kingga\LaravelWorkflowTimesheet\WorkflowEntry;

/**
 * The model for the week.
 */
class WorkflowWeek extends Model
{
    /**
     * Cast these columns to Carbon objects.
     *
     * @var array
     */
    protected $dates = [
        'start',
        'end',
    ];

    /**
     * Get all entries which are attached to this week.
     *
     * @return HasMany
     */
    public function entries()
    {
        return $this->hasMany(WorkflowEntry::class, 'week_id');
    }

    /**
     * Add the object structure generated from kingga/workflow to the database.
     *
     * @param Week $week The week to add.
     *
     * @return WorkflowWeek The model which was generated.
     */
    public static function create(Week $week): WorkflowWeek
    {
        $model = new WorkflowWeek;

        DB::transaction(function () use ($week, &$model) {
            $user = Auth::user();

            $model->start = $week->getStart()->format('Y-m-d');
            $model->end = $week->getEnd()->format('Y-m-d');
            $model->user_id = $user->id;
            $model->save();

            foreach ($week->getDays() as $day) {
                $date = $day->getDate()->format('Y-m-d');

                foreach ($day->getEntries() as $entry) {
                    // Create the job if it doesn't already exist.
                    $job = WorkflowJob::updateOrCreate(
                        ['job_id' => $entry->getJobId(), 'user_id' => $user->id],
                        [
                            'job_id' => $entry->getJobId(),
                            'user_id' => $user->id,
                            'name' => $entry->getJob(),
                            'client' => $entry->getClient(),
                        ]
                    );

                    // Create the task if it doesn't exist.
                    $task = WorkflowTask::updateOrCreate(
                        ['job_id' => $job->id, 'name' => $entry->getTask()],
                        ['job_id' => $job->id, 'name' => $entry->getTask()]
                    );

                    // Add the entry.
                    $e = new WorkflowEntry;
                    $e->week_id = $model->id;
                    $e->task_id = $task->id;
                    $e->date = $date;
                    $e->time = $entry->getTime();
                    $e->save();
                }
            }
        });

        return $model;
    }

    /**
     * Convert the database back to an object for usage in code.
     *
     * @return Week The week object.
     */
    public function toObject(): Week
    {
        // Eager load in the relationships.
        $this->load('entries.task.job');

        $week = new Week;
        $week->setStart($this->start);
        $week->setEnd($this->end);

        // Group the entries by their date.
        $days = $this->entries->groupBy('dateString');

        foreach ($days as $date => $day) {
            $d = new Day(DateTime::createFromFormat('Y-m-d', $date));

            foreach ($day as $entry) {
                $d->addEntry(new Entry(
                    $entry->task->job->client,
                    $entry->task->job->id,
                    $entry->task->job->name,
                    $entry->task->name,
                    $entry->time
                ));
            }

            $week->addDay($d);
        }

        return $week;
    }
}
