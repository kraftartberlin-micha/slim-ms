<?php declare(strict_types=1);

namespace Project\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\Mapper\ProductArrayMapper;
use Project\Repository\ProductRepository;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\Router;

/**
 * @covers \Project\Router
 * @backupGlobals enabled
 */
class RouterTest extends TestCase
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var IndexGetRequestHandler
     */
    private $indexGetRequestHandler;

    /**
     * @var ProductGetRequestHandler
     */
    private $productGetRequestHandler;

    /**
     * @var ProductPostRequestHandler
     */
    private $productPostRequestHandler;

    public function setUp(): void
    {
        $this->response = new Response();
        $this->indexGetRequestHandler = new IndexGetRequestHandler();
        $productRepository = new ProductRepository(new ProductArrayMapper());
        $this->productGetRequestHandler = new ProductGetRequestHandler($productRepository);
        $this->productPostRequestHandler = new ProductPostRequestHandler($productRepository);
    }

    public function testCanRouteToIndex(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => 'index'];
        $request = new Request();
        $response = $this->startRouting($request);
        TestCase::assertEquals('index', $response->getBody());
    }

    public function testCanRouteToProduct(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => 'product'];
        $request = new Request();
        $response = $this->startRouting($request);
        TestCase::assertIsString($response->getBody());
    }
    public function testCanRouteToSaveProduct(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => 'product'];
        $_REQUEST = ['name'=>'test', 'priceInCent'=>'12345', 'description'=>'test'];
        $request = new Request();
        $response = $this->startRouting($request);
        TestCase::assertStringContainsString('12345', $response->getBody());
    }

    private function startRouting(Request $request): Response
    {
        $router = new Router(
            $request,
            $this->response,
            $this->indexGetRequestHandler,
            $this->productGetRequestHandler,
            $this->productPostRequestHandler
        );
        return $router->route();
    }

}
