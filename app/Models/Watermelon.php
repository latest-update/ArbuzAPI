<?php

namespace App\Models;

use App\Exceptions\InvalidPurchaseException;
use ErrorException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Collection;

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

    /*
     *  От фронтенда отправляется координаты где распологаются арбузы которые купил пользователь
     *  @function getFew() получает эти координаты и возвращяет в виде объектов с свойствами id, weight, status, place_id
     */
    public static function getFew(Collection $purchase): Collection
    {
        $all = static::getAll();

        try {

            $purchase = $purchase->map(function ($item) use ($all) {
                return $all[$item['row'] - 1][ $item['place'] - 1];
            });

        } catch (ErrorException $e) {
            throw new InvalidPurchaseException();
        }

        return $purchase;
    }

    public static function checkStatus(int $row, int $place): ?object
    {
        try {
            $watermelon = Row::find($row)->places()->get();
            $watermelon = $watermelon->pluck('watermelon')[ $place-1 ];
        } catch (ErrorException $e) {
            throw new InvalidPurchaseException();
        }

        return $watermelon;
    }

    public function place (): BelongsTo
    {
        return $this->belongsTo(Place::class);
    }
}
