<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Maintenance extends Model
{
    use HasFactory;

    protected $fillable = ['maintainable_type', 'maintainable_id', 'status'];

    public function maintainable(): MorphTo
    {
        return $this->morphTo();
    }
}
