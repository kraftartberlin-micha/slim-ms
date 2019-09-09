<?php declare(strict_types=1);

namespace Project\Tests\Unit\Values;

use PHPUnit\Framework\TestCase;
use Project\Exceptions\ProductIdIsNegativeException;
use Project\Values\ProductId;

/**
 * @covers \Project\Values\ProductId
 */
class ProductIdTest extends TestCase
{
    public function testCanCreateAndGetProductId(): void
    {
        $id = 1;
        $productId =new ProductId($id);
        TestCase::assertEquals($id, $productId->getInt());
    }

    public function testWithNegativeNumberShouldThrowException(): void
    {
        $this->expectException(ProductIdIsNegativeException::class);
        new ProductId(-5);
    }

}
