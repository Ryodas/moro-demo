<?php
// services/auth-service/app/Http/Middleware/ValidateJwtToken.php
namespace App\Http\Middleware;

use TanaryoCloud\Shared\Services\JwtService;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ValidateJwtToken
{
    private JwtService $jwtService;

    public function __construct(JwtService $jwtService)
    {
        $this->jwtService = $jwtService;
    }

    public function handle(Request $request, Closure $next)
    {
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json([
                'status' => 'error',
                'message' => '認証トークンが必要です'
            ], Response::HTTP_UNAUTHORIZED);
        }

        try {
            $payload = $this->jwtService->verify($token);
            $request->merge(['auth_payload' => $payload]);
            return $next($request);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => '無効なトークンです'
            ], Response::HTTP_UNAUTHORIZED);
        }
    }
}
