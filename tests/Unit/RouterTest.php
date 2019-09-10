<?php declare(strict_types=1);

namespace Project\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\Router;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;

/**
 * @covers \Project\Router
 */
class RouterTest extends TestCase
{
    /**
     * @var array
     */
    public $handler;

    /**
     * @var array
     */
    public $requestArray;

    /**
     * @var array
     */
    public $serverArray;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|Request
     */
    private $request;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|Response
     */
    private $response;

    public function setUp(): void
    {
        $this->handler = [
            'index' => $this->createMock(IndexGetRequestHandler::class),
            'productGet' => $this->createMock(ProductGetRequestHandler::class),
            'productPost' => $this->createMock(ProductPostRequestHandler::class),
        ];

        $this->request = $this->createMock(Request::class);
        $this->response = $this->createMock(Response::class);
    }

    public function testWillRoutedToIndexGetWhenNothingMatch(): void
    {
        $this->request->expects($this->once())->method('uri')->willReturn('/dfg');

        $indexGetRequestHandler = $this->createMock(IndexGetRequestHandler::class);
        $indexGetRequestHandler->expects($this->once())->method('handle')->willReturn($this->response);

        $router = new Router(
            $this->request,
            $this->response,
            $indexGetRequestHandler,
            $this->handler['productGet'],
            $this->handler['productPost']
        );

        $router->route();
    }

    public function testWillRoutedToIndexGetWhenUriIsIndex(): void
    {
        $this->request->expects($this->once())->method('uri')->willReturn('/index');

        $indexGetRequestHandler = $this->createMock(IndexGetRequestHandler::class);
        $indexGetRequestHandler->expects($this->once())->method('handle')->willReturn($this->response);

        $router = new Router(
            $this->request,
            $this->response,
            $indexGetRequestHandler,
            $this->handler['productGet'],
            $this->handler['productPost']
        );

        $router->route();
    }

    public function testWillRoutedToProductGetWhenUriIsProduct(): void
    {
        $this->request->expects($this->once())->method('uri')->willReturn('/product');
        $this->request->expects($this->once())->method('method')->willReturn('get');

        $productGetRequestHandler = $this->createMock(ProductGetRequestHandler::class);
        $productGetRequestHandler->expects($this->once())->method('handle')->willReturn($this->response);

        $router = new Router(
            $this->request,
            $this->response,
            $this->handler['index'],
            $productGetRequestHandler,
            $this->handler['productPost']
        );

        $router->route();
    }

    public function testWillRoutedToProductGetWhenUriIsProductAndPost(): void
    {
        $this->request->expects($this->once())->method('uri')->willReturn('/product');
        $this->request->expects($this->once())->method('method')->willReturn('post');

        $productPostRequestHandler = $this->createMock(ProductPostRequestHandler::class);
        $productPostRequestHandler->expects($this->once())->method('handle')->willReturn($this->response);

        $router = new Router(
            $this->request,
            $this->response,
            $this->handler['index'],
            $this->handler['productGet'],
            $productPostRequestHandler
        );

        $router->route();
    }

}
