<?php
// tanaryo-cloud/shared/src/Contracts/LotteryServiceInterface.php
namespace TanaryoCloud\Shared\Contracts;

interface LotteryServiceInterface
{
    public function draw(array $items, ?array $weights = null): string;
}
