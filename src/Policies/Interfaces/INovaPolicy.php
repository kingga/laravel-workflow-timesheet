<?php

/**
 * This interface contains all of the functions which a nova policy must implement.
 *
 * @author Isaac Skelton <contact@isaacskelton.com>
 * @since 1.0.0
 * @package Kingga\LaravelWorkflowTimesheet\Policies\Interfaces
 */

namespace Kingga\LaravelWorkflowTimesheet\Policies\Interfaces;

/**
 * This is actually used for the nova package but it works well for this package as well.
 */
interface INovaPolicy
{
    /**
     * Can the user view any of the resources. This will completely hide it from the
     * user.
     *
     * @param User $user The current user.
     *
     * @return bool Can they view it?
     */
    public function viewAny($user): bool;

    /**
     * Can this user view this particular model?
     *
     * @param User $user The current user.
     * @param Model $model The model to check.
     *
     * @return bool Can they view it?
     */
    public function view($user, $model): bool;

    /**
     * Can the user create a resource for this model?
     *
     * @param User $user The current user.
     *
     * @return bool Can they create this model?
     */
    public function create($user): bool;

    /**
     * Can the user update a particular model.
     *
     * @param User $user The current user.
     * @param Model $model The model to update.
     *
     * @return bool Can they update the model?
     */
    public function update($user, $model): bool;

    /**
     * Can they delete a particular model.
     *
     * @param User $user The current user.
     * @param Model $model The model to delete.
     *
     * @return bool Can they delete the model?
     */
    public function delete($user, $model): bool;

    /**
     * Can they restore a particular soft deleted model.
     *
     * @param User $user The current user.
     * @param Model $model The model to restore.
     *
     * @return bool Can they restore the model?
     */
    public function restore($user, $model): bool;

    /**
     * Can they force delete a model with soft deletes?
     *
     * @param User $user The current user.
     * @param Model $model The model to force delete.
     *
     * @return bool Can they force delete the model?
     */
    public function forceDelete($user, $model): bool;
}
