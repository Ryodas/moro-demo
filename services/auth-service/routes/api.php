<?php
// services/auth-service/routes/api.php
use App\Http\Controllers\AuthController;

Route::post('/validate-key', [AuthController::class, 'validateApiKey']);
