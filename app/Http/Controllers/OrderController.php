<?php

namespace App\Http\Controllers;

use App\Custom\Response\ShortResponse;
use App\Http\Requests\OrderRequest;
use App\Models\Order;
use App\Models\Purchased_watermelons;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function all(): JsonResponse
    {
        return ShortResponse::json(Order::all());
    }

    public function search(string $phone){
        return ShortResponse::json( Order::where('phone_number', $phone)->get() );
    }

    public function create (OrderRequest $request): JsonResponse
    {
        $data = $request->validated();

        $order = Order::createOrder(collect($data));
        Purchased_watermelons::setPurchasedWatermelons($order);

        return ShortResponse::json(['message' => 'Order created successfully, you can check order status by phone number']);
    }
}
