<?php

namespace App\Observers;

use App\Domain\Material\Models\Material;
use App\Events\MaterialActionEvent;
use App\Models\ActionType;

class MaterialObserver
{
    /**
     * Handle the Material "created" event.
     */
    public function created(Material $material): void
    {
        event(new MaterialActionEvent($material, ActionType::MATERIAL_CREATED));
    }

    /**
     * Handle the Material "updated" event.
     */
    public function updated(Material $material): void
    {
        event(new MaterialActionEvent($material, ActionType::MATERIAL_UPDATED));
    }

    /**
     * Handle the Material "deleted" event.
     */
    public function deleted(Material $material): void
    {
        event(new MaterialActionEvent($material, ActionType::MATERIAL_DELETED));
    }

    /**
     * Handle the Material "restored" event.
     */
    public function restored(Material $material): void
    {
        //
    }

    /**
     * Handle the Material "force deleted" event.
     */
    public function forceDeleted(Material $material): void
    {
        //
    }
}
