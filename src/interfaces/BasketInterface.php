<?php

namespace AcmeWidgetCo\interfaces;

/**
 * Interface for the Basket class
 */
interface BasketInterface
{
    /**
     * Adds a product to the basket
     *
     * @param string $productCode The product code to add
     */
    public function add(string $productCode): void;

    /**
     * Returns the total cost of the basket
     *
     * @return string The total cost formatted as a string
     */
    public function total(): string;
}
