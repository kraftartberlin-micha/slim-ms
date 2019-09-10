<?php declare(strict_types=1);

namespace Project\Tests\Integration\RequestHandler;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\Product\Mapper\ProductArrayMapper;
use Project\Product\Adapter\ProductAdapter;
use Project\RequestHandler\ProductGetRequestHandler;

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
     * @var ProductAdapter
     */
    private $productRepository;

    /**
     * @var Response
     */
    private $response;

    public function setUp(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => 'product'];
        $this->request = new Request();
        $this->response = new Response();
        $this->productRepository = new ProductAdapter(new ProductArrayMapper());
    }

    public function testCanHandleRequest(): void
    {
        $productGetRequestHandler = new ProductGetRequestHandler($this->productRepository);
        $response = $productGetRequestHandler->handle($this->request, $this->response);
        TestCase::assertIsString($response->getBody());
    }

}
