<?php

namespace AcmeWidgetCo;

use AcmeWidgetCo\interfaces\DeliveryCostStrategyInterface;

/**
 * Class for calculating delivery costs
 */
class DeliveryCostStrategy implements DeliveryCostStrategyInterface
{
    /**
     * @var array<int, float> Delivery cost rules
     */
    private array $rules;

    /**
     * DeliveryCostStrategy constructor
     *
     * @param array<int, float> $rules Delivery cost rules
     */
    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

    /**
     * Calculates the delivery cost based on the subtotal
     *
     * @param float $subtotal The subtotal of the basket
     * @return float The delivery cost
     */
    public function calculate(float $subtotal): float
    {
        foreach ($this->rules as $limit => $cost) {
            if ($subtotal < $limit) {
                return $cost;
            }
        }
        return 0.0;
    }
}
