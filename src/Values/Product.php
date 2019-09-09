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
     * @var ProductPrice
     */
    private $productPrice;

    public function __construct(
        ProductId $productId,
        ProductName $productName,
        ProductDescription $productDescription,
        ProductPrice $productPrice
    ) {
        $this->productId = $productId;
        $this->productName = $productName;
        $this->productDescription = $productDescription;
        $this->productPrice = $productPrice;
    }

    /**
     * @return ProductPrice
     */
    public function getProductPrice(): ProductPrice
    {
        return $this->productPrice;
    }

    /**
     * @return ProductDescription
     */
    public function getProductDescription(): ProductDescription
    {
        return $this->productDescription;
    }

    /**
     * @return ProductName
     */
    public function getProductName(): ProductName
    {
        return $this->productName;
    }

    /**
     * @return ProductId
     */
    public function getProductId(): ProductId
    {
        return $this->productId;
    }
}