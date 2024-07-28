<?php

namespace AcmeWidgetCo\interfaces;

interface DeliveryCostStrategyInterface
{
    public function calculate(float $subtotal): float;
}
