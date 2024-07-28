<?php

use PHPUnit\Framework\TestCase;
use AcmeWidgetCo\Basket;
use AcmeWidgetCo\DeliveryCostStrategy;
use AcmeWidgetCo\OfferStrategy;
use AcmeWidgetCo\Product;

class BasketTest extends TestCase
{
    /**
     * @var array<string, Product>
     */
    private array $catalogue;

    /**
     * @var DeliveryCostStrategy
     */
    private DeliveryCostStrategy $deliveryStrategy;

    /**
     * @var OfferStrategy
     */
    private OfferStrategy $offerStrategy;

    protected function setUp(): void
    {
        $this->catalogue = [
            'R01' => new Product('R01', 'Red Widget', 32.95),
            'G01' => new Product('G01', 'Green Widget', 24.95),
            'B01' => new Product('B01', 'Blue Widget', 7.95)
        ];

        $this->deliveryStrategy = new DeliveryCostStrategy([
            50 => 4.95,
            90 => 2.95,
            PHP_INT_MAX => 0.0
        ]);

        $this->offerStrategy = new OfferStrategy();
    }

    // @phpstan-ignore-next-line
    public function testTotalB01G01()
    {
        $basket = new Basket($this->catalogue, $this->deliveryStrategy, $this->offerStrategy);
        $basket->add('B01');
        $basket->add('G01');
        $this->assertEquals('37.85', $basket->total());
    }

    // @phpstan-ignore-next-line
    public function testTotalR01R01()
    {
        $basket = new Basket($this->catalogue, $this->deliveryStrategy, $this->offerStrategy);
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals('54.38', $basket->total());
    }

    // @phpstan-ignore-next-line
    public function testTotalR01G01()
    {
        $basket = new Basket($this->catalogue, $this->deliveryStrategy, $this->offerStrategy);
        $basket->add('R01');
        $basket->add('G01');
        $this->assertEquals('60.85', $basket->total());
    }

    // @phpstan-ignore-next-line
    public function testTotalComplexBasket()
    {
        $basket = new Basket($this->catalogue, $this->deliveryStrategy, $this->offerStrategy);
        $basket->add('B01');
        $basket->add('B01');
        $basket->add('R01');
        $basket->add('R01');
        $basket->add('R01');
        $this->assertEquals('98.28', $basket->total());
    }
}
