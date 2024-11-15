<?php
// services/lottery-service/routes/api.php

use App\Http\Controllers\LotteryController;
use Illuminate\Support\Facades\Route;

Route::middleware('jwt.verify')->group(function () {
    Route::post('/draw', [LotteryController::class, 'draw']);
});
