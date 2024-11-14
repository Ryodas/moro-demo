<?php
// services/lottery-service/app/Http/Controllers/LotteryController.php
namespace App\Http\Controllers;

use App\Services\LotteryService;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LotteryController extends Controller
{
    private LotteryService $lotteryService;

    public function __construct(LotteryService $lotteryService)
    {
        $this->lotteryService = $lotteryService;
    }

    public function draw(Request $request)
    {
        $request->validate([
            'items' => 'required|array|min:1',
            'items.*' => 'required|string',
            'weights' => 'nullable|array',
            'weights.*' => 'numeric'
        ]);

        // プラン制限のチェック
        $authPayload = $request->get('auth_payload');
        if ($authPayload['plan'] === 'basic' && count($request->items) > 10) {
            return response()->json([
                'status' => 'error',
                'message' => 'Basicプランでは最大10個までのアイテムしか選択できません'
            ], Response::HTTP_FORBIDDEN);
        }

        try {
            $result = $this->lotteryService->draw(
                $request->items,
                $request->weights
            );

            return response()->json([
                'status' => 'success',
                'result' => $result,
                'timestamp' => now()->toIsoString()
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage()
            ], Response::HTTP_BAD_REQUEST);
        }
    }
}
