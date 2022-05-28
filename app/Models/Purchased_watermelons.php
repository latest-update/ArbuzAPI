<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchased_watermelons extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function order (): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
