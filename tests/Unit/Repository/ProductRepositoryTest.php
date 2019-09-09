<?php declare(strict_types=1);

namespace Project\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Project\Mapper\ProductArrayMapper;
use Project\Repository\ProductRepository;

/**
 * @covers \Project\Repository\ProductRepository
 */
class ProductRepositoryTest extends TestCase
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function setUp(): void
    {
        $this->productRepository = new ProductRepository(new ProductArrayMapper());
    }

    public function testProductRepositoryCanDeliverData(): void
    {
        $products = $this->productRepository->getAll();
        TestCase::assertNotEmpty($products);
    }

    public function testProductRepositoryCanSaveData(): void
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

}
