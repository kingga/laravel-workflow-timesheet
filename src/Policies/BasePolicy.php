<?php

/**
 * The base policy for all models since they act very similar.
 *
 * @author Isaac Skelton <contact@isaacskelton.com>
 * @since 1.0.0
 * @package Kingga\LaravelWorkflowTimesheet\Policies
 */

namespace Kingga\LaravelWorkflowTimesheet\Policies;

use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * The base policy.
 */
abstract class BasePolicy implements Interfaces\INovaPolicy
{
    use HandlesAuthorization;

    /**
     * Check if this belongs to the current user.
     *
     * @return bool Does belongs to the current user?
     */
    final protected function sameUser($user, $model): bool
    {
        return $user->id === $model->user_id;
    }

    /**
     * {@inheritDoc}
     */
    public function view($user, $model): bool
    {
        return $this->sameUser($user, $model);
    }

    /**
     * {@inheritDoc}
     */
    public function create($user): bool
    {
        return true;
    }

    /**
     * {@inheritDoc}
     */
    public function update($user, $model): bool
    {
        return $this->sameUser($user, $model);
    }

    /**
     * {@inheritDoc}
     */
    public function delete($user, $model): bool
    {
        return $this->sameUser($user, $model);
    }

    /**
     * {@inheritDoc}
     */
    public function forceDelete($user, $model): bool
    {
        return $this->sameUser($user, $model);
    }
}
