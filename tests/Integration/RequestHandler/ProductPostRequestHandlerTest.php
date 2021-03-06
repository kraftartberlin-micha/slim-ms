<?php declare(strict_types=1);

namespace Project\Tests\Integration\RequestHandler;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\Product\Mapper\ProductArrayMapper;
use Project\Product\Adapter\ProductAdapter;
use Project\RequestHandler\ProductPostRequestHandler;

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
     * @var ProductAdapter
     */
    private $productRepository;

    /**
     * @var Response
     */
    private $response;

    public function setUp(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => 'product'];
        $_REQUEST = ['name'=>'test', 'priceInCent'=>'12345', 'description'=>'test'];
        $this->request = new Request();
        $this->response = new Response();
        $this->productRepository = new ProductAdapter(new ProductArrayMapper());
    }

    public function testCanHandleRequest(): void
    {
        $productPostRequestHandler = new ProductPostRequestHandler($this->productRepository);
        $response = $productPostRequestHandler->handle($this->request, $this->response);
        TestCase::assertStringContainsString('12345', $response->getBody());
    }

}
