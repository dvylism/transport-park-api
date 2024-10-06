<?php

namespace App\Enums;

enum FleetSetStatus: string
{
    case WORKS = 'works';
    case FREE = 'free';
    case DOWNTIME = 'downtime';
}
