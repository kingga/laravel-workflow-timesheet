<?php

/**
 * The policy for WorkflowTask.
 *
 * @author Isaac Skelton <contact@isaacskelton.com>
 * @since 1.0.0
 * @package Kingga\LaravelWorkflowTimesheet\Policies
 */

namespace Kingga\LaravelWorkflowTimesheet\Policies;

use Kingga\LaravelWorkflowTimesheet\Policies\WorkflowJobPolicy;

/**
 * The auth policy for the WorkflowTask model.
 */
class WorkflowTaskPolicy extends WorkflowJobPolicy
{
    /**
     * {@inheritDoc}
     */
    final protected function sameUser($user, $task): bool
    {
        $job = $task->job;

        if ($job) {
            return $user->id === $job->user_id;
        } else {
            return $user->id === $task->entries->first()->week->user_id;
        }
    }
}
