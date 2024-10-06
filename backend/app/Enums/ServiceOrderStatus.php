<?php

namespace App\Enums;

enum ServiceOrderStatus: string
{
    case IN_SERVICE = 'in_service';
    case COMPLETED = 'completed';
}
