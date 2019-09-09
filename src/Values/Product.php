<?php
declare(strict_types=1);

namespace Project\Values;

class Product
{
    /**
     * @var ProductId
     */
    private $productId;

    /**
     * @var ProductName
     */
    private $productName;

    /**
     * @var ProductDescription
     */
    private $productDescription;

    /**
     * @var ProductPriceInCents
     */
    private $productPriceInCents;

    public function __construct(
        ProductId $productId,
        ProductName $productName,
        ProductDescription $productDescription,
        ProductPriceInCents $productPriceInCents
    ) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productDescription = $productDescription;
        $this->productPriceInCents = $productPriceInCents;
    }

    public function getProductPriceInCents(): ProductPriceInCents
    {
        return $this->productPriceInCents;
    }

    public function getProductDescription(): ProductDescription
    {
        return $this->productDescription;
    }

    public function getProductName(): ProductName
    {
        return $this->productName;
    }

    public function getProductId(): ProductId
    {
        return $this->productId;
    }
}