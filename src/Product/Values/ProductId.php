<?php
declare(strict_types=1);

namespace Project\Product\Values;

use Project\Exceptions\ProductIdIsNegativeException;

class ProductId
{
    /**
     * @var int
     */
    private $int;

    /**
     * @throws ProductIdIsNegativeException
     */
    public function __construct(int $int)
    {
        $this->ensureIsNotNegative($int);
        $this->int = $int;
    }

    /**
     * @throws ProductIdIsNegativeException
     */
    private function ensureIsNotNegative(int $int)
    {
        if($int < 0){
            throw new ProductIdIsNegativeException('ID cant be negative!');
        }
    }

    public function getInt(): int
    {
        return $this->int;
    }
}