<?php
declare(strict_types=1);

namespace Project\Product\Mapper;

use Project\Exceptions\ProductNameIsEmptyException;
use Project\Exceptions\ProductPriceInCentsIsNegativeException;
use Project\Product\Values\Product;
use Project\Product\Values\ProductDescription;
use Project\Product\Values\ProductId;
use Project\Product\Values\ProductName;
use Project\Product\Values\ProductPriceInCents;

class ProductArrayMapper
{
    /**
     * @throws ProductNameIsEmptyException
     * @throws ProductPriceInCentsIsNegativeException
     * @throws \Project\Exceptions\ProductIdIsNegativeException
     */
    public function mapArrayToObject(array $array)
    {
        return new Product(
            new ProductId((int) (isset($array['id']) ? $array['id'] : 0)),
            new ProductName($array['name']),
            new ProductDescription($array['description']),
            new ProductPriceInCents((int)$array['priceInCent'])
        );
    }

    public function mapObjectToArray(Product $product): array
    {
        $array['id'] = $product->getProductId()->getInt();
        $array['name'] = $product->getProductName()->getString();
        $array['description'] = $product->getProductDescription()->getString();
        $array['priceInCent'] = $product->getProductPriceInCents()->getInt();
        return $array;
    }

}