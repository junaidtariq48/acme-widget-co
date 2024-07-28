<?php

use PHPUnit\Framework\TestCase;
use AcmeWidgetCo\OfferStrategy;

class OfferStrategyTest extends TestCase
{
    /**
     * @var OfferStrategy
     */
    private OfferStrategy $offerStrategy;

    protected function setUp(): void
    {
        $this->offerStrategy = new OfferStrategy();
    }

    // @phpstan-ignore-next-line
    public function testApplyNoOffer()
    {
        $productCode = 'G01'; // Product without any offer
        $price = 24.95;
        $quantity = 3;
        $expectedTotal = $price * $quantity;

        $this->assertEquals($expectedTotal, $this->offerStrategy->apply($productCode, $quantity, $price));
    }

    // @phpstan-ignore-next-line
    public function testApplyBuyOneGetHalfPriceOddQuantity()
    {
        $productCode = 'R01'; // Product with buy one get half price offer
        $price = 32.95;
        $quantity = 3; // Odd quantity

        $expectedTotal = $price + ($price / 2) + $price;

        $this->assertEquals($expectedTotal, $this->offerStrategy->apply($productCode, $quantity, $price));
    }

    // @phpstan-ignore-next-line
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
