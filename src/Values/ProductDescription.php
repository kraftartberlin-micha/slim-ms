<?php
declare(strict_types=1);

namespace Project\Values;

use Project\Exceptions\ProductDescriptionIsEmptyException;

class ProductDescription
{
    /**
     * @var string
     */
    private $description;

    /**
     * @throws ProductDescriptionIsEmptyException
     */
    public function __construct(string $description)
    {
        $this->ensureIsNotEmpty($description);
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @throws ProductDescriptionIsEmptyException
     */
    private function ensureIsNotEmpty(string $name)
    {
        if(empty(trim($name))){
            throw new ProductDescriptionIsEmptyException('Description cant be empty!');
        }
    }
}