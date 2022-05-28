<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    public function watermelons(): HasMany
    {
        return $this->hasMany(Purchased_watermelons::class);
    }
}
