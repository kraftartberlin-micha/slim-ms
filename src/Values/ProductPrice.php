<?php
declare(strict_types=1);

namespace Project\Values;

use Project\Exceptions\ProductPriceIsNegativeException;

class ProductPrice
{
    /**
     * @var int
     */
    private $priceInCents;

    /**
     * @throws ProductPriceIsNegativeException
     */
    public function __construct(int $price)
    {
        $this->ensureIsNotNegative($price);
        $this->priceInCents = $price;
    }

    /**
     * @throws ProductPriceIsNegativeException
     */
    private function ensureIsNotNegative(int $number)
    {
        if($number < 0){
            throw new ProductPriceIsNegativeException('Price cant be negative!');
        }
    }

    /**
     * @return int
     */
    public function getPriceInCents(): int
    {
        return $this->priceInCents;
    }
}