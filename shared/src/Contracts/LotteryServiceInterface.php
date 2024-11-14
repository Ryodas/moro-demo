<?php
// tanaryo-cloud/shared/src/Contracts/LotteryServiceInterface.php
namespace TanaryoCloud\Shared\Contracts;

interface LotteryServiceInterface
{
    /**
     * くじ引きを実行する
     *
     * @param array $items 選択肢の配列
     * @param array|null $weights 重みの配列（オプション）
     * @return string 選ばれた項目
     */
    public function draw(array $items, ?array $weights = null): string;
}
