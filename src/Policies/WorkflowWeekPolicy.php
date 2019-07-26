<?php

/**
 * The policy for WorkflowWeek.
 *
 * @author Isaac Skelton <contact@isaacskelton.com>
 * @since 1.0.0
 * @package Kingga\LaravelWorkflowTimesheet\Policies
 */

namespace Kingga\LaravelWorkflowTimesheet\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Kingga\LaravelWorkflowTimesheet\WorkflowWeek;
use Kingga\LaravelWorkflowTimesheet\Policies\BasePolicy;

/**
 * The auth policy for the WorkflowWeek model.
 */
class WorkflowWeekPolicy extends BasePolicy
{
    /**
     * {@inheritDoc}
     */
    public function viewAny($user): bool
    {
        // If the user has a week, otherwise they don't need to see it.
        return WorkflowWeek::where('user_id', $user->id)->exists();
    }
}
