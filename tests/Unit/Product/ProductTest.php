<?php declare(strict_types=1);

namespace Project\Tests\Unit\Product;

use PHPUnit\Framework\TestCase;
use Project\Product\Values\Product;
use Project\Product\Values\ProductDescription;
use Project\Product\Values\ProductId;
use Project\Product\Values\ProductName;
use Project\Product\Values\ProductPriceInCents;

/**
 * @covers \Project\Product\Values\Product
 */
class ProductTest extends TestCase
{
    /**
     * @var Product
     */
    private $product;

    public function setUp(): void
    {
        $productId = $this->createMock(ProductId::class);
        $productName = $this->createMock(ProductName::class);
        $productDescription = $this->createMock(ProductDescription::class);
        $productPriceInCents = $this->createMock(ProductPriceInCents::class);
        $this->product = new Product(
            $productId,
            $productName,
            $productDescription,
            $productPriceInCents
        );
    }

    public function testCanGetProductId(): void
    {
        TestCase::assertInstanceOf(ProductId::class, $this->product->getProductId());
    }
    public function testCanGetProductName(): void
    {
        TestCase::assertInstanceOf(ProductName::class, $this->product->getProductName());
    }
    public function testCanGetProductDescription(): void
    {
        TestCase::assertInstanceOf(ProductDescription::class, $this->product->getProductDescription());
    }
    public function testCanGetProductPriceInCents(): void
    {
        TestCase::assertInstanceOf(ProductPriceInCents::class, $this->product->getProductPriceInCents());
    }
}
