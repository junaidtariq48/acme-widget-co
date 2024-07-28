<?php

use PHPUnit\Framework\TestCase;
use AcmeWidgetCo\OfferStrategy;

class OfferStrategyTest extends TestCase
{
    private OfferStrategy $offerStrategy;

    protected function setUp(): void
    {
        $this->offerStrategy = new OfferStrategy();
    }

    public function testApplyNoOffer()
    {
        $productCode = 'G01'; // Product without any offer
        $price = 24.95;
        $quantity = 3;
        $expectedTotal = $price * $quantity;

        $this->assertEquals($expectedTotal, $this->offerStrategy->apply($productCode, $quantity, $price));
    }

    public function testApplyBuyOneGetHalfPriceOddQuantity()
    {
        $productCode = 'R01'; // Product with buy one get half price offer
        $price = 32.95;
        $quantity = 3; // Odd quantity

        // (32.95 + 16.475) + (32.95 + 16.475) + 32.95 = 98.825
        $expectedTotal = (2 * ($price + $price / 2)) + $price;

        $this->assertEquals($expectedTotal, $this->offerStrategy->apply($productCode, $quantity, $price));
    }

    public function testApplyBuyOneGetHalfPriceEvenQuantity()
    {
        $productCode = 'R01'; // Product with buy one get half price offer
        $price = 32.95;
        $quantity = 4; // Even quantity

        // (32.95 + 16.475) * 2 = 98.85
        $expectedTotal = 2 * ($price + $price / 2);

        $this->assertEquals($expectedTotal, $this->offerStrategy->apply($productCode, $quantity, $price));
    }
}
