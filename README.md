# Acme Widget Co Sales System

This project is a proof of concept for a sales system for Acme Widget Co. It includes a basket that calculates total costs, including delivery charges and special offers.

## How it Works

### Product Catalogue
The product catalogue is defined using the `Product` class which holds product details (code, name, price).

### Delivery Charge Rules
Delivery charges are determined based on the total basket value:
- Orders under $50 cost $4.95.
- Orders under $90 cost $2.95.
- Orders of $90 or more have free delivery.

### Special Offers
Currently, the system supports the following special offer:
- Buy one red widget (R01), get the second half price.

### Basket Class
The `Basket` class implements the `BasketInterface` and provides methods to add products and calculate the total cost:
- `add($productCode)`: Adds a product to the basket.
- `total()`: Returns the total cost of the basket, including delivery and special offers.

### Project Structure

acme-widget-co/
├── src/
│ ├── Basket.php
│ ├── DeliveryCostStrategy.php
│ ├── OfferStrategy.php
│ ├── Product.php
│ └── interfaces/
│ ├── BasketInterface.php
│ ├── DeliveryCostStrategyInterface.php
│ ├── OfferStrategyInterface.php
├── tests/
│ ├── BasketTest.php
│ ├── DeliveryCostStrategyTest.php
│ └── OfferStrategyTest.php
├── docker-compose.yml
├── Dockerfile
├── composer.json
├── composer.lock
├── phpunit.xml
└── README.md


### Usage

#### Running with Docker
To run this system using Docker:

1. Build and run the Docker container:
    ```bash
    docker-compose up --build
    ```

2. Access the application at `http://localhost:8088`.

#### Running Tests
To run the tests:
```bash
docker-compose run app vendor/bin/phpunit
```

#### Running Static Analysis
To run PHPStan:
```
docker-compose run app vendor/bin/phpstan analyse
```

#### Assumptions
- Product codes in the add method must exist in the product catalogue.
- Special offers are applied based on hardcoded logic in the `OfferStrategy` class.