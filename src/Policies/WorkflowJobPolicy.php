<?php

/**
 * The policy for WorkflowJob.
 *
 * @author Isaac Skelton <contact@isaacskelton.com>
 * @since 1.0.0
 * @package Kingga\LaravelWorkflowTimesheet\Policies
 */

namespace Kingga\LaravelWorkflowTimesheet\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;
use Kingga\LaravelWorkflowTimesheet\WorkflowJob;
use Kingga\LaravelWorkflowTimesheet\Policies\BasePolicy;

/**
 * The auth policy for the WorkflowJob model.
 */
class WorkflowJobPolicy extends BasePolicy
{
    /**
     * {@inheritDoc}
     */
    public function viewAny($user): bool
    {
        // If the user has a job, otherwise they don't need to see it.
        return WorkflowJob::where('user_id', $user->id)->exists();
    }
}
