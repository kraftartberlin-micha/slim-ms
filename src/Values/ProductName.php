<?php
declare(strict_types=1);

namespace Project\Values;

use Project\Exceptions\ProductNameIsEmptyException;

class ProductName
{
    /**
     * @var string
     */
    private $name;

    /**
     * @throws ProductNameIsEmptyException
     */
    public function __construct(string $name)
    {
        $this->ensureIsNotEmpty($name);
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @throws ProductNameIsEmptyException
     */
    private function ensureIsNotEmpty(string $name)
    {
        if(empty(trim($name))){
            throw new ProductNameIsEmptyException('Name cant be empty!');
        }
    }
}