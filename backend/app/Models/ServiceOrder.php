<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class ServiceOrder extends Model
{
    use HasFactory;

    protected $fillable = ['serviceable_type', 'serviceable_id', 'status'];

    public function serviceable(): MorphTo
    {
        return $this->morphTo();
    }
}
