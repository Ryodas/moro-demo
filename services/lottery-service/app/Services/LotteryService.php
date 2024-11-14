<?php
// services/lottery-service/app/Services/LotteryService.php
namespace App\Services;

use TanaryoCloud\Shared\Contracts\LotteryServiceInterface;

class LotteryService implements LotteryServiceInterface
{
    public function draw(array $items, ?array $weights = null): string
    {
        if (empty($items)) {
            throw new \InvalidArgumentException('Items array cannot be empty');
        }

        if ($weights !== null && count($items) !== count($weights)) {
            throw new \InvalidArgumentException('Items and weights must have the same length');
        }

        if ($weights === null) {
            return $items[array_rand($items)];
        }

        $total = array_sum($weights);
        $random = mt_rand(1, $total * 100) / 100;

        $currentWeight = 0;
        foreach ($items as $index => $item) {
            $currentWeight += $weights[$index];
            if ($random <= $currentWeight) {
                return $item;
            }
        }

        return end($items);
    }
}
