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
        return $user->id === $task->job->user_id;
    }
}
