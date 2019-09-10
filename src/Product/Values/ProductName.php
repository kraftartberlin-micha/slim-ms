<?php
declare(strict_types=1);

namespace Project\Product\Values;

use Project\Exceptions\ProductNameIsEmptyException;

class ProductName
{
    /**
     * @var string
     */
    private $string;

    /**
     * @throws ProductNameIsEmptyException
     */
    public function __construct(string $string)
    {
        $this->ensureIsNotEmpty($string);
        $this->string = $string;
    }

    public function getString(): string
    {
        return $this->string;
    }

    /**
     * @throws ProductNameIsEmptyException
     */
    private function ensureIsNotEmpty(string $string)
    {
        if(empty(trim($string))){
            throw new ProductNameIsEmptyException('Name cant be empty!');
        }
    }
}