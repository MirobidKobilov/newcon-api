<?php

namespace App\Observers;

use App\Events\UserActionEvent;
use App\Models\ActionType;
use App\Models\User;

class UserObserver
{
    /**
     * Handle the User "created" event.
     */
    public function created(User $user): void
    {
        event(new UserActionEvent($user, ActionType::USER_CREATED));
    }

    /**
     * Handle the User "updated" event.
     */
    public function updated(User $user): void
    {
        event(new UserActionEvent($user, ActionType::USER_UPDATED));
    }

    /**
     * Handle the User "deleted" event.
     */
    public function deleted(User $user): void
    {
        event(new UserActionEvent($user, ActionType::USER_DELETED));
    }

    /**
     * Handle the User "restored" event.
     */
    public function restored(User $user): void
    {
        event(new UserActionEvent($user, ActionType::USER_RESTORED));
    }

    /**
     * Handle the User "force deleted" event.
     */
    public function forceDeleted(User $user): void
    {
        event(new UserActionEvent($user, ActionType::USER_FORCE_DELETED));
    }
}
