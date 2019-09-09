<?php declare(strict_types=1);

namespace Project\Tests\Unit\Values;

use PHPUnit\Framework\TestCase;
use Project\Exceptions\ProductNameIsEmptyException;
use Project\Values\ProductName;

/**
 * @covers \Project\Values\ProductName
 */
class ProductNameTest extends TestCase
{
    public function testCanCreateAndGetProductName(): void
    {
        $name = 'eyefone';
        $productId =new ProductName($name);
        TestCase::assertEquals($name, $productId->getString());
    }

    public function testEmptyStringShouldThrowException(): void
    {
        $this->expectException(ProductNameIsEmptyException::class);
        new ProductName('');
    }

    public function testOnlyWhitespaceShouldThrowException(): void
    {
        $this->expectException(ProductNameIsEmptyException::class);
        new ProductName(' ');
    }

}
