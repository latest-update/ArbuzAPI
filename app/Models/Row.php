<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Row extends Model
{
    use HasFactory;

    public $timestamps = false;

    public $hidden = [
        'id',
        'order'
    ];

    public function places (): HasMany
    {
        return $this->hasMany(Place::class)->with('watermelon');
    }
}
