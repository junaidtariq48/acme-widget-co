<?php

namespace AcmeWidgetCo\interfaces;

/**
 * Interface for delivery cost strategy
 */
interface DeliveryCostStrategyInterface
{
    /**
     * Calculates the delivery cost based on the subtotal
     *
     * @param float $subtotal The subtotal of the basket
     * @return float The delivery cost
     */
    public function calculate(float $subtotal): float;
}
