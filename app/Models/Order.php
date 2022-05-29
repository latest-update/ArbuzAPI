<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Collection;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'operation_time',
        'total_weight',
        'address',
        'phone_number',
        'delivery_time',
        'delivered',
        'cut'
    ];

    /**
     * @param Collection $data
     * @return array [created order, purchased watermelons]
     * @throws \App\Exceptions\InvalidPurchaseException
     */
    public static function createOrder(Collection $data): array
    {
        $watermelons = Watermelon::getFew( collect( $data['purchase'] ) );

        $order = $data->merge([
            'operation_time' => now()->format('Y-m-d H:i:s'),
            'total_weight' => $watermelons->sum('weight'),
            'delivered' => false
        ]);

        return [
            'order' => static::create( $order->toArray() ),
            'purchase' => $watermelons
        ];
    }

    public function watermelons(): HasMany
    {
        return $this->hasMany(Purchased_watermelons::class);
    }
}
