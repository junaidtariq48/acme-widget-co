<?php

namespace AcmeWidgetCo\interfaces;

interface OfferStrategyInterface
{
    public function apply(string $productCode, int $quantity, float $price): float;
}
