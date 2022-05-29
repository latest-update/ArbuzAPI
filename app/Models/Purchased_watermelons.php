<?php

namespace App\Models;

use App\Exceptions\InvalidPurchaseException;
use ErrorException;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Purchased_watermelons extends Model
{
    use HasFactory;

    public $timestamps = false;

    public static function setPurchasedWatermelons(array $order)
    {
        try {
            $watermelons = collect($order['purchase']);
            Watermelon::whereIn('id', $watermelons->map(fn($item) => $item['id']) )->delete();

            $watermelons = $watermelons->map(function ($item) use ($order){
                return [
                    'status' => $item['status'],
                    'weight' => $item['weight'],
                    'order_id' => $order['order']->id
                ];
            });
        } catch (ErrorException $e) {
            throw new InvalidPurchaseException();
        }

        static::upsert(
            $watermelons->toArray(),
            ['order_id']
        );
    }

    public function order (): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
