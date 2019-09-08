<?php declare(strict_types=1);

namespace Project\Tests\Unit;

use PHPUnit\Framework\TestCase;
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
        $this->productRepository = new ProductRepository();
    }

    public function testProductRepositoryCanDeliverData(): void
    {
        $products = $this->productRepository->getAll();
        TestCase::assertEquals('get', $products);
    }

    public function testProductRepositoryCanSaveData(): void
    {
        $products = $this->productRepository->save([]);
        TestCase::assertEquals('post', $products);
    }

}
