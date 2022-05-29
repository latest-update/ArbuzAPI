<?php

namespace App\Http\Controllers;

use App\Custom\Response\ShortResponse;
use App\Models\Watermelon;
use Illuminate\Http\JsonResponse;

class ArbuzController extends Controller
{
    public function all(): JsonResponse
    {
        return ShortResponse::json(Watermelon::getAll());
    }

    public function check(int $row, int $place): JsonResponse
    {
        return ShortResponse::json(Watermelon::checkStatus($row, $place));
    }
}
