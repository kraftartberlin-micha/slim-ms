<?php
declare(strict_types=1);

namespace Project\Values;

use Project\Exceptions\ProductPriceInCentsIsNegativeException;

class ProductPriceInCents
{
    /**
     * @var int
     */
    private $int;

    /**
     * @throws ProductPriceInCentsIsNegativeException
     */
    public function __construct(int $int)
    {
        $this->ensureIsNotNegative($int);
        $this->int = $int;
    }

    /**
     * @throws ProductPriceInCentsIsNegativeException
     */
    private function ensureIsNotNegative(int $int)
    {
        if($int < 0){
            throw new ProductPriceInCentsIsNegativeException('Price cant be negative!');
        }
    }

    public function getInt(): int
    {
        return $this->int;
    }
}