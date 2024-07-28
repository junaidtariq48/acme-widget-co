<?php

namespace AcmeWidgetCo;

use AcmeWidgetCo\interfaces\OfferStrategyInterface;

/**
 * Class for applying special offers
 */
class OfferStrategy implements OfferStrategyInterface
{
    /**
     * Applies the offer to a product
     *
     * @param string $productCode The product code
     * @param int $quantity The quantity of the product
     * @param float $price The price of the product
     * @return float The total cost after applying the offer
     */
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
