<?php


namespace App\Custom\Response;


use Illuminate\Http\JsonResponse;

class ShortResponse
{
    public static function json($data, int $statusCode = 200): JsonResponse
    {
        return response()->json($data, $statusCode);
    }

    public static function errorMessage (string $error, int $status = 404) : JsonResponse
    {
        return response()->json([
            'message' => $error
        ], $status);
    }
}
