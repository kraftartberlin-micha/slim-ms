<?php declare(strict_types=1);

namespace Project\Tests\Unit\Values;

use PHPUnit\Framework\TestCase;
use Project\Exceptions\ProductPriceInCentsIsNegativeException;
use Project\Values\ProductPriceInCents;

/**
 * @covers \Project\Values\ProductPriceInCents
 */
class ProductPriceInCentsTest extends TestCase
{
    public function testCanCreateAndGetProductPriceInCents(): void
    {
        $price = 100;
        $productPriceInCents =new ProductPriceInCents($price);
        TestCase::assertEquals($price, $productPriceInCents->getInt());
    }

    public function testWithNegativeNumberShouldThrowException(): void
    {
        $this->expectException(ProductPriceInCentsIsNegativeException::class);
        new ProductPriceInCents(-5);
    }

}
