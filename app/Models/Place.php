<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Place extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = [
        'id',
        'place',
        'row_id'
    ];

    public function row(): BelongsTo
    {
        return $this->belongsTo(Row::class);
    }

    public function watermelon(): HasOne
    {
        return $this->hasOne(Watermelon::class);
    }
}
