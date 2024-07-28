<?php

namespace AcmeWidgetCo\interfaces;

/**
 * Interface for offer strategy
 */
interface OfferStrategyInterface
{
    /**
     * Applies the offer to a product
     *
     * @param string $productCode The product code
     * @param int $quantity The quantity of the product
     * @param float $price The price of the product
     * @return float The total cost after applying the offer
     */
    public function apply(string $productCode, int $quantity, float $price): float;
}
