<?php

use PHPUnit\Framework\TestCase;
use AcmeWidgetCo\DeliveryCostStrategy;

class DeliveryCostStrategyTest extends TestCase
{
    public function testCalculateUnder50()
    {
        $strategy = new DeliveryCostStrategy([50 => 4.95, 90 => 2.95, PHP_INT_MAX => 0.0]);
        $this->assertEquals(4.95, $strategy->calculate(49.99));
    }

    public function testCalculateUnder90()
    {
        $strategy = new DeliveryCostStrategy([50 => 4.95, 90 => 2.95, PHP_INT_MAX => 0.0]);
        $this->assertEquals(2.95, $strategy->calculate(89.99));
    }

    public function testCalculateOver90()
    {
        $strategy = new DeliveryCostStrategy([50 => 4.95, 90 => 2.95, PHP_INT_MAX => 0.0]);
        $this->assertEquals(0.0, $strategy->calculate(90.00));
    }
}
