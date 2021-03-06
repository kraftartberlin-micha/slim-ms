<?php declare(strict_types=1);

namespace Project\Tests\Unit\Product\Adapter;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Project\Exceptions\ProductNotFoundException;
use Project\Product\Mapper\ProductArrayMapper;
use Project\Product\Adapter\ProductAdapter;
use Project\Product\Values\Product;
use Project\Product\Values\ProductDescription;
use Project\Product\Values\ProductId;
use Project\Product\Values\ProductName;
use Project\Product\Values\ProductPriceInCents;

/**
 * @covers \Project\Product\Adapter\ProductAdapter
 */
class ProductAdapterTest extends TestCase
{
    /**
     * @var ProductAdapter
     */
    private $productRepository;

    /**
     * @var int
     */
    private $testId;

    /**
     * @var int
     */
    private $testPrice;

    public function setUp(): void
    {
        $this->testId = 1;
        $this->testPrice = 1234;
        $this->productRepository = new ProductAdapter(new ProductArrayMapper());
    }

    public function testCanDeliverAllData(): void
    {
        $products = $this->productRepository->getAll();
        TestCase::assertNotEmpty($products);
    }

    public function testCanDeliverAllDataAsArray(): void
    {
        $products = $this->productRepository->getAll(true);
        TestCase::assertNotEmpty($products[0]);
    }

    public function testCanDeliverOneData(): void
    {
        $products = $this->productRepository->get($this->testId);
        TestCase::assertInstanceOf(Product::class, $products);
    }

    public function testCanDeliverOneDataAsArray(): void
    {
        $products = $this->productRepository->get($this->testId, true);
        TestCase::assertNotEmpty($products);
    }

    public function testCanNotFindProductShouldThrowException(): void
    {
        $this->expectException(ProductNotFoundException::class);
        $this->productRepository->get(500);
    }

    public function testCanSaveNewProduct(): void
    {
        $products_old = $this->productRepository->getAll();
        $this->productRepository->save($this->getProductMock());
        $products = $this->productRepository->getAll();
        TestCase::assertTrue(count($products) > (count($products_old)));
    }

    public function testCanSaveNewProductArray(): void
    {
        $products_old = $this->productRepository->getAll();
        $this->productRepository->saveArray([
            'name' => 'test',
            'priceInCent' => '12345',
            'description' => 'test'
        ]);
        $products = $this->productRepository->getAll();
        TestCase::assertTrue(count($products) > (count($products_old)));
    }

    public function testCanSaveExistsProduct(): void
    {
        $this->productRepository->save($this->getProductMock(true));
        $product = $this->productRepository->get($this->testId);
        TestCase::assertEquals($this->testPrice, $product->getProductPriceInCents()->getInt());
    }

    public function testCanSaveExistsProductArray(): void
    {
        $this->productRepository->saveArray([
            'id' => $this->testId,
            'name' => 'test',
            'priceInCent' => $this->testPrice,
            'description' => 'test'
        ]);
        $product = $this->productRepository->get($this->testId);
        TestCase::assertEquals($this->testPrice, $product->getProductPriceInCents()->getInt());
    }


    public function testSaveNonExistsProductWithIdShouldThrowException(): void
    {
        $this->expectException(ProductNotFoundException::class);
        $this->productRepository->saveArray([
            'id' => 500,
            'name' => 'test',
            'priceInCent' => $this->testPrice,
            'description' => 'test'
        ]);
        $this->productRepository->get($this->testId);
    }

    /**
     * @return MockObject|Product
     */
    private function getProductMock($withId = false)
    {
        $productname = $this->createMock(ProductName::class);
        $productname->method('getString')->willReturn('Name');
        $productDescription = $this->createMock(ProductDescription::class);
        $productDescription->method('getString')->willReturn('Description');
        $productPrice = $this->createMock(ProductPriceInCents::class);
        $productPrice->method('getInt')->willReturn($this->testPrice);
        $product = $this->createMock(Product::class);
        $product->method('getProductName')->willReturn($productname);
        $product->method('getProductDescription')->willReturn($productDescription);
        $product->method('getProductPriceInCents')->willReturn($productPrice);
        if($withId){
            $productId = $this->createMock(ProductId::class);
            $productId->method('getInt')->willReturn($this->testId);
            $product->method('getProductId')->willReturn($productId);
        }
        return $product;
    }

}
