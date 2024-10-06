<?php

namespace App\Enums;

enum MaintenanceStatus: string
{
    case IN_PROGRESS = 'in_progress';
    case COMPLETED = 'completed';
}
