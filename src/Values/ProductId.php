<?php
declare(strict_types=1);

namespace Project\Values;

use Project\Exceptions\ProductPriceIsNegativeException;

class ProductId
{
    /**
     * @var int
     */
    private $number;

    /**
     * @throws ProductPriceIsNegativeException
     */
    public function __construct(int $number)
    {
        $this->ensureIsNotNegative($number);
        $this->number = $number;
    }

    /**
     * @throws ProductPriceIsNegativeException
     */
    private function ensureIsNotNegative(int $number)
    {
        if($number < 0){
            throw new ProductPriceIsNegativeException('ID cant be negative!');
        }
    }

    /**
     * @return int
     */
    public function getNumber(): int
    {
        return $this->number;
    }
}