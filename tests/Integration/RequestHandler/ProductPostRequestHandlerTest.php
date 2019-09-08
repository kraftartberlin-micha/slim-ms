<?php declare(strict_types=1);

namespace Project\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\Repository\ProductRepository;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\Services\ProductService;

/**
 * @covers \Project\RequestHandler\ProductPostRequestHandler
 * @backupGlobals enabled
 */
class ProductPostRequestHandlerTest extends TestCase
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
        $_SERVER = ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => 'product'];
        $this->request = new Request();
        $this->response = new Response();
        $this->productService = new ProductService(new ProductRepository());
    }

    public function testCanHandleRequest(): void
    {
        $productPostRequestHandler = new ProductPostRequestHandler($this->productService);
        $response = $productPostRequestHandler->handle($this->request, $this->response);
        TestCase::assertEquals('post', $response->getBody());
    }

}
