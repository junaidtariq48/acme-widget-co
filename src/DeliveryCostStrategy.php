<?php

namespace AcmeWidgetCo;

use AcmeWidgetCo\interfaces\DeliveryCostStrategyInterface;

class DeliveryCostStrategy implements DeliveryCostStrategyInterface
{
    private array $rules;

    public function __construct(array $rules)
    {
        $this->rules = $rules;
    }

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
