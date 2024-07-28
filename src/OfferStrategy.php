<?php

namespace AcmeWidgetCo;

use AcmeWidgetCo\interfaces\OfferStrategyInterface;

class OfferStrategy implements OfferStrategyInterface
{
    public function apply(string $productCode, int $quantity, float $price): float
    {
        $total = 0.0;

        if ($productCode === 'R01') {
            $pairs = intdiv($quantity, 2);
            $total += $pairs * ($price + $price / 2);
            if ($quantity % 2 !== 0) {
                $total += $price;
            }
        } else {
            $total += $price * $quantity;
        }

        return $total;
    }
}
