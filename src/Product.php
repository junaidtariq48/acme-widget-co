<?php

namespace AcmeWidgetCo;

/**
 * Class representing a product
 */
class Product
{
    /**
     * @var string Product code
     */
    private string $code;

    /**
     * @var string Product name
     */
    private string $name;

    /**
     * @var float Product price
     */
    private float $price;

    /**
     * Product constructor
     *
     * @param string $code Product code
     * @param string $name Product name
     * @param float $price Product price
     */
    public function __construct(string $code, string $name, float $price)
    {
        $this->code = $code;
        $this->name = $name;
        $this->price = $price;
    }

    /**
     * Gets the product code
     *
     * @return string The product code
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * Gets the product name
     *
     * @return string The product name
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Gets the product price
     *
     * @return float The product price
     */
    public function getPrice(): float
    {
        return $this->price;
    }
}
