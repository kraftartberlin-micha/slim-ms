<?php declare(strict_types=1);

namespace Project\Tests\Unit;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Project\Exceptions\HandlerNotFoundException;
use Project\Http\Request;
use Project\Http\Response;
use Project\RequestHandler\RequestHandlerCollection;
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
     * @var MockObject|Request
     */
    private $request;

    /**
     * @var MockObject|Response
     */
    private $response;

    /**
     * @var MockObject|RequestHandlerCollection
     */
    private $requestHandlerCollection;


    public function setUp(): void
    {
        $this->handler = [
            'index' => $this->createMock(IndexGetRequestHandler::class),
            'productGet' => $this->createMock(ProductGetRequestHandler::class),
            'productPost' => $this->createMock(ProductPostRequestHandler::class),
        ];

        $this->request = $this->createMock(Request::class);
        $this->response = $this->createMock(Response::class);
        $this->requestHandlerCollection = $this->createMock(RequestHandlerCollection::class);
    }

    public function testUnknownRoutShouldThrowException(): void
    {
        $this->requestHandlerCollection->method('getHandler')->willThrowException(new HandlerNotFoundException());
        $this->expectException(HandlerNotFoundException::class);
        $this->setRequest('get', '/dfg');
        $router= new Router(
            $this->request,
            $this->response,
            $this->requestHandlerCollection
        );

        $router->route();
    }

    public function testWillRoutedToIndexGetWhenUriIsIndex(): void
    {
        $this->setRequest('get', '/index');

        $indexGetRequestHandler = $this->createMock(IndexGetRequestHandler::class);
        $indexGetRequestHandler->expects($this->once())->method('handle')->willReturn($this->response);

        $this->requestHandlerCollection->method('getHandler')->willReturn($indexGetRequestHandler);

        $router = new Router(
            $this->request,
            $this->response,
            $this->requestHandlerCollection
        );

        $router->route();
    }

    public function testWillRoutedToProductGetWhenUriIsProduct(): void
    {
        $this->setRequest('get', '/product');

        $productGetRequestHandler = $this->createMock(ProductGetRequestHandler::class);
        $productGetRequestHandler->expects($this->once())->method('handle')->willReturn($this->response);

        $this->requestHandlerCollection->method('getHandler')->willReturn($productGetRequestHandler);

        $router = new Router(
            $this->request,
            $this->response,
            $this->requestHandlerCollection
        );

        $router->route();
    }

    public function testWillRoutedToProductGetWhenUriIsProductAndPost(): void
    {
        $this->setRequest('post', '/product');

        $productPostRequestHandler = $this->createMock(ProductPostRequestHandler::class);
        $productPostRequestHandler->expects($this->once())->method('handle')->willReturn($this->response);

        $this->requestHandlerCollection->method('getHandler')->willReturn($productPostRequestHandler);

        $router = new Router(
            $this->request,
            $this->response,
            $this->requestHandlerCollection
        );

        $router->route();
    }

    private function setRequest(string $method, string $url): void
    {
        $this->request->expects($this->once())->method('method')->willReturn($method);
        $this->request->expects($this->once())->method('uri')->willReturn($url);
    }

}
