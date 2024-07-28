<?php

namespace AcmeWidgetCo;

use AcmeWidgetCo\interfaces\BasketInterface;
use AcmeWidgetCo\interfaces\DeliveryCostStrategyInterface;
use AcmeWidgetCo\interfaces\OfferStrategyInterface;

class Basket implements BasketInterface
{
    private array $catalogue;
    private DeliveryCostStrategyInterface $deliveryStrategy;
    private OfferStrategyInterface $offerStrategy;
    private array $items = [];

    public function __construct(
        array $catalogue,
        DeliveryCostStrategyInterface $deliveryStrategy,
        OfferStrategyInterface $offerStrategy
    ) {
        $this->catalogue = $catalogue;
        $this->deliveryStrategy = $deliveryStrategy;
        $this->offerStrategy = $offerStrategy;
    }

    public function add(string $productCode): void
    {
        if (isset($this->catalogue[$productCode])) {
            $this->items[] = $productCode;
        } else {
            throw new \Exception("Product code {$productCode} not found in catalogue.");
        }
    }

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
