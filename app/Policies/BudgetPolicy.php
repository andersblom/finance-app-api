<?php

namespace App\Policies;

use App\User;
use App\Budget;
use Illuminate\Auth\Access\HandlesAuthorization;

class BudgetPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view the budget.
     *
     * @param  \App\User  $user
     * @param  \App\Budget  $budget
     * @return bool
     */
    public function view(User $user, Budget $budget)
    {
        // TODO: make public budgets viewable
        return $this->isCreatedByUser($user, $budget);
    }

    /**
     * Determine whether the user can update the budget.
     *
     * @param  \App\User  $user
     * @param  \App\Budget  $budget
     * @return bool
     */
    public function update(User $user, Budget $budget)
    {
        return $this->isCreatedByUser($user, $budget);
    }

    /**
     * Determine whether the user can delete the budget.
     *
     * @param  \App\User  $user
     * @param  \App\Budget  $budget
     * @return bool
     */
    public function delete(User $user, Budget $budget)
    {
        return $this->isCreatedByUser($user, $budget);
    }

    /**
     * Determine whether the user can restore the budget.
     *
     * @param  \App\User  $user
     * @param  \App\Budget  $budget
     * @return mixed
     */
    public function restore(User $user, Budget $budget)
    {
        return $this->isCreatedByUser($user, $budget);
    }

    /**
     * Determine whether the user has created the budget.
     *
     * @param  \App\User  $user
     * @param  \App\Budget  $budget
     * @return bool
     */
    private function isCreatedByUser(User $user, Budget $budget)
    {
        return (int) $user->id === (int) $budget->user_id;
    }
}
