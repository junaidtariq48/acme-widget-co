<?php

namespace AcmeWidgetCo;

use AcmeWidgetCo\interfaces\BasketInterface;
use AcmeWidgetCo\interfaces\DeliveryCostStrategyInterface;
use AcmeWidgetCo\interfaces\OfferStrategyInterface;

/**
 * Class representing a shopping basket
 */
class Basket implements BasketInterface
{
    /**
     * @var array<string, Product> Product catalogue
     */
    private array $catalogue;

    /**
     * @var DeliveryCostStrategyInterface Delivery cost strategy
     */
    private DeliveryCostStrategyInterface $deliveryStrategy;

    /**
     * @var OfferStrategyInterface Offer strategy
     */
    private OfferStrategyInterface $offerStrategy;

    /**
     * @var array<int, string> Items in the basket
     */
    private array $items = [];

    /**
     * Basket constructor
     *
     * @param array<string, Product> $catalogue Product catalogue
     * @param DeliveryCostStrategyInterface $deliveryStrategy Delivery cost strategy
     * @param OfferStrategyInterface $offerStrategy Offer strategy
     */
    public function __construct(
        array $catalogue,
        DeliveryCostStrategyInterface $deliveryStrategy,
        OfferStrategyInterface $offerStrategy
    ) {
        $this->catalogue = $catalogue;
        $this->deliveryStrategy = $deliveryStrategy;
        $this->offerStrategy = $offerStrategy;
    }

    /**
     * Adds a product to the basket
     *
     * @param string $productCode The product code to add
     * @throws \Exception If the product code is not found in the catalogue
     */
    public function add(string $productCode): void
    {
        if (isset($this->catalogue[$productCode])) {
            $this->items[] = $productCode;
        } else {
            throw new \Exception("Product code {$productCode} not found in catalogue.");
        }
    }

    /**
     * Returns the total cost of the basket
     *
     * @return string The total cost formatted as a string
     */
    public function total(): string
    {
        $subtotal = 0.0;
        $productCounts = array_count_values($this->items);

        foreach ($productCounts as $productCode => $count) {
            $price = $this->catalogue[$productCode]->getPrice();
            $subtotal += $this->offerStrategy->apply($productCode, $count, $price);
        }

        $deliveryCost = $this->deliveryStrategy->calculate($subtotal);
        $total = $subtotal + $deliveryCost;

        return number_format($total, 2);
    }
}
