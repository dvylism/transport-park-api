<?php

namespace App\Interfaces;

interface Maintainable
{
    public function isUnderService(): bool;
}
