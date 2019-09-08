<?php declare(strict_types=1);

namespace Project\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\Repository\ProductRepository;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\Router;
use Project\Services\ProductService;

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
        $productService = new ProductService(new ProductRepository());
        $this->productGetRequestHandler = new ProductGetRequestHandler($productService);
        $this->productPostRequestHandler = new ProductPostRequestHandler($productService);
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
        TestCase::assertEquals('get', $response->getBody());
    }
    public function testCanRouteToSaveProduct(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => 'product'];
        $request = new Request();
        $response = $this->startRouting($request);
        TestCase::assertEquals('post', $response->getBody());
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
