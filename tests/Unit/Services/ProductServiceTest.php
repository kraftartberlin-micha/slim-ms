<?php declare(strict_types=1);

namespace Project\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Project\Repository\ProductRepository;
use Project\Services\ProductService;

/**
 * @covers \Project\Services\ProductService
 */
class ProductServiceTest extends TestCase
{
    /**
     * @var ProductService
     */
    private $productService;

    public function setUp(): void
    {
        $productRepository = $this->createMock(ProductRepository::class);
        $productRepository->method('getAll')->willReturn('get');
        $productRepository->method('save')->willReturn('post');
        $this->productService = new ProductService($productRepository);
    }

    public function testCanGetProducts(): void
    {
        $products = $this->productService->getProducts();
        TestCase::assertEquals('get', $products);
    }

    public function testCanSaveProducts(): void
    {
        $products = $this->productService->saveProduct([]);
        TestCase::assertEquals('post', $products);
    }

}
