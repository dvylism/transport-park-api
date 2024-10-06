<?php

namespace App\Traits;

use App\Enums\ServiceOrderStatus;

trait ServiceableTrait
{
    public function isInService(): bool
    {
        return $this->serviceOrders->contains(function ($serviceOrder): bool {
            return $serviceOrder->status === ServiceOrderStatus::IN_SERVICE->value;
        });
    }
}
