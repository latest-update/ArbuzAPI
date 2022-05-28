<?php

use App\Http\Controllers\ArbuzController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::controller(ArbuzController::class)->group(function () {
    Route::get('/arbuz', 'all');        // Получить все арбузы в виде массива рядов, каждый ряд является массивом внутри которого содержится объекты арбуза
    Route::get('/arbuz/{row}/{place}', 'check');        // Проверить статус арбуза: неспелый, спелый, уже сорван а так же вес
});
