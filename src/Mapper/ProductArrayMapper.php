<?php
declare(strict_types=1);

namespace Project\Mapper;

use Project\Values\Product;
use Project\Values\ProductDescription;
use Project\Values\ProductId;
use Project\Values\ProductName;
use Project\Values\ProductPrice;

class ProductArrayMapper
{

    public function mapArrayToObject(array $array)
    {
        return new Product(
            new ProductId((int) (isset($array['id']) ? $array['id'] : 0)),
            new ProductName($array['name']),
            new ProductDescription($array['description']),
            new ProductPrice((int)$array['priceInCent'])
        );
    }

    public function mapObjectToArray(Product $product): array
    {
        $array['id'] = $product->getProductId()->getNumber();
        $array['name'] = $product->getProductName()->getName();
        $array['description'] = $product->getProductDescription()->getDescription();
        $array['priceInCent'] = $product->getProductPrice()->getPriceInCents();
        return $array;
    }

}