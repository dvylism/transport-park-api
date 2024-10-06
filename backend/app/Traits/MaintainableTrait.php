<?php

namespace App\Traits;

use App\Enums\MaintenanceStatus;

trait MaintainableTrait
{
    public function isUnderService(): bool
    {
        return $this->maintenances->contains(function ($maintenance): bool {
            return $maintenance->status === MaintenanceStatus::IN_PROGRESS->value;
        });
    }
}
