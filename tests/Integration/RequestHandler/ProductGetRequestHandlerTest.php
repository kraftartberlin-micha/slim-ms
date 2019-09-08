<?php declare(strict_types=1);

namespace Project\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\Repository\ProductRepository;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\Services\ProductService;

/**
 * @covers \Project\RequestHandler\ProductGetRequestHandler
 * @backupGlobals enabled
 */
class ProductGetRequestHandlerTest extends TestCase
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var ProductService
     */
    private $productService;

    /**
     * @var Response
     */
    private $response;

    public function setUp(): void
    {
        $this->testResponseString = 'test';
        $_SERVER = ['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => 'product'];
        $this->request = new Request();
        $this->response = new Response();
        $this->productService = new ProductService(new ProductRepository());
    }

    public function testCanHandleRequest(): void
    {
        $productGetRequestHandler = new ProductGetRequestHandler($this->productService);
        $response = $productGetRequestHandler->handle($this->request, $this->response);
        TestCase::assertEquals('get', $response->getBody());
    }

}
