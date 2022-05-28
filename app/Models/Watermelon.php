<?php

namespace App\Models;

use ErrorException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Route;
use mysql_xdevapi\Exception;

class Watermelon extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $hidden = [
        'place_id'
    ];

    public static function getAll(): Collection
    {
        $all = Row::with('places')->get();
        $all = $all->pluck('places.*.watermelon');
        return $all;
    }

    public static function checkStatus(int $row, int $place): ?object
    {
        try {
            $wm = Row::find($row)->places()->get();
            $wm = $wm->pluck('watermelon')[ $place-1 ];
        } catch (ErrorException $e) {
            throw new ModelNotFoundException();
        }

        return $wm;
    }

    public function place (): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
