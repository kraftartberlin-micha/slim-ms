<?php declare(strict_types=1);

namespace Project\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Project\Exceptions\HandlerNotFoundException;
use Project\Http\Request;
use Project\Http\Response;
use Project\Product\Mapper\ProductArrayMapper;
use Project\Product\Adapter\ProductAdapter;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\RequestHandler\RequestHandlerCollection;
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
        $productRepository = new ProductAdapter(new ProductArrayMapper());
        $this->productGetRequestHandler = new ProductGetRequestHandler($productRepository);
        $this->productPostRequestHandler = new ProductPostRequestHandler($productRepository);
    }

    public function testCanRouteToIndex(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/'];
        $request = new Request();
        $response = $this->startRouting($request);
        TestCase::assertEquals('index', $response->getBody());
    }

    public function testUnkownRouteShouldThrowException(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/im/not/correct'];
        $request = new Request();
        $this->expectException(HandlerNotFoundException::class);
        $this->startRouting($request);
    }

    public function testCanRouteToProduct(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/product'];
        $request = new Request();
        $response = $this->startRouting($request);
        TestCase::assertIsString($response->getBody());
    }
    public function testCanRouteToSaveProduct(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'POST', 'REQUEST_URI' => '/product'];
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
            new RequestHandlerCollection(
                $this->indexGetRequestHandler,
                $this->productGetRequestHandler,
                $this->productPostRequestHandler
            )
        );
        return $router->route();
    }

}
