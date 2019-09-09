<?php declare(strict_types=1);

namespace Project\Tests\Unit\Values;

use PHPUnit\Framework\TestCase;
use Project\Values\ProductDescription;

/**
 * @covers \Project\Values\ProductDescription
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
