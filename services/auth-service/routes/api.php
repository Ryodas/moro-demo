<?php
// services/auth-service/routes/api.php
use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::post('/validate-key', [AuthController::class, 'validateApiKey']);
