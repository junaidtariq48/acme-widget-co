<?php

namespace AcmeWidgetCo\interfaces;

interface BasketInterface
{
    public function add(string $productCode): void;
    public function total(): string;
}
