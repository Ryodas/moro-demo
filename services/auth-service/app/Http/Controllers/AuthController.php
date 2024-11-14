<?php
// services/auth-service/app/Http/Controllers/AuthController.php
namespace App\Http\Controllers;

use App\Models\ApiKey;
use TanaryoCloud\Shared\Services\JwtService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    private JwtService $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function validateApiKey(Request $request)
    {
        $request->validate([
            'api_key' => 'required|string'
        ]);

        $apiKey = ApiKey::where('key', $request->api_key)
            ->where('is_active', true)
            ->first();

        if (!$apiKey) {
            return response()->json([
                'status' => 'error',
                'message' => '無効なAPIキーです'
            ], Response::HTTP_UNAUTHORIZED);
        }

        $token = $this->jwtService->generate([
            'sub' => $apiKey->key,
            'plan' => $apiKey->plan,
            'user_id' => $apiKey->user_id
        ]);

        $apiKey->update(['last_used_at' => now()]);

        return response()->json([
            'status' => 'success',
            'token' => $token,
            'expires_at' => now()->addDay()->toIsoString()
        ]);
    }
}
