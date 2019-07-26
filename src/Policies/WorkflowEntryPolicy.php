<?php

/**
 * The policy for WorkflowEntry.
 *
 * @author Isaac Skelton <contact@isaacskelton.com>
 * @since 1.0.0
 * @package Kingga\LaravelWorkflowTimesheet\Policies
 */

namespace Kingga\LaravelWorkflowTimesheet\Policies;

use Kingga\LaravelWorkflowTimesheet\Policies\WorkflowWeekPolicy;

/**
 * The auth policy for the WorkflowEntry model.
 */
class WorkflowEntryPolicy extends WorkflowWeekPolicy
{
    /**
     * {@inheritDoc}
     */
    final protected function sameUser($user, $entry): bool
    {
        return $user->id === $entry->week->user_id;
    }
}
