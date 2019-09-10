<?php declare(strict_types=1);

namespace Project\Tests\Unit\Product\Mapper;

use PHPUnit\Framework\TestCase;
use Project\Product\Mapper\ProductArrayMapper;
use Project\Product\Values\Product;

/**
 * @covers \Project\Product\Mapper\ProductArrayMapper
 */
class ProductArrayMapperTest extends TestCase
{
    /**
     * @var ProductArrayMapper
     */
    private $productArrayMapper;

    public function setUp(): void
    {
        $this->productArrayMapper = new ProductArrayMapper();
    }

    public function testCanMapArrayToObject(): void
    {
        $array = [
            'id' => 1,
            'name' => 'name',
            'description' => 'desc',
            'priceInCent' => '1234'
        ];
        $product = $this->productArrayMapper->mapArrayToObject($array);
        TestCase::assertInstanceOf(Product::class, $product);
    }

    public function testCanMapObjectToArray(): void
    {
        $product = $this->createMock(Product::class);
        $productArray = $this->productArrayMapper->mapObjectToArray($product);
        TestCase::assertIsArray($productArray);
    }
}
