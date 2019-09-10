<?php declare(strict_types=1);

namespace Project\Tests\Unit\Product;

use PHPUnit\Framework\TestCase;
use Project\Product\Values\ProductDescription;

/**
 * @covers \Project\Product\Values\ProductDescription
 */
class ProductDescriptionTest extends TestCase
{
    public function testCanCreateAndGetProductDescription(): void
    {
        $name = 'eyefone';
        $productId = new ProductDescription($name);
        TestCase::assertEquals($name, $productId->getString());
    }

    public function testEmptyStringPossible(): void
    {
        $name = '';
        $productId = new ProductDescription($name);
        TestCase::assertEquals($name, $productId->getString());
    }

}
