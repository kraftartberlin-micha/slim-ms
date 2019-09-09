<?php declare(strict_types=1);

namespace Project\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\Mapper\ProductArrayMapper;
use Project\Repository\ProductRepository;
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
     * @var ProductRepository
     */
    private $productRepository;

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
        $this->productRepository = new ProductRepository(new ProductArrayMapper());
    }

    public function testCanHandleRequest(): void
    {
        $productGetRequestHandler = new ProductGetRequestHandler($this->productRepository);
        $response = $productGetRequestHandler->handle($this->request, $this->response);
        TestCase::assertIsString($response->getBody());
    }

}
