<?php declare(strict_types=1);

namespace Project\Tests\Unit;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Project\Exceptions\HandlerNotFoundException;
use Project\Http\Request;
use Project\Http\Response;
use Project\Router;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\Values\Method;
use Project\Values\Url;

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
     * @var MockObject|Method
     */
    private $method;

    /**
     * @var MockObject|Url
     */
    private $url;


    public function setUp(): void
    {
        $this->handler = [
            'index' => $this->createMock(IndexGetRequestHandler::class),
            'productGet' => $this->createMock(ProductGetRequestHandler::class),
            'productPost' => $this->createMock(ProductPostRequestHandler::class),
        ];

        $this->request = $this->createMock(Request::class);
        $this->response = $this->createMock(Response::class);
        $this->url = $this->createMock(Url::class);
        $this->method = $this->createMock(Method::class);
    }

    public function testUnknownRoutShouldThrowException(): void
    {
        $this->expectException(HandlerNotFoundException::class);
        $this->setRequest('get', '/dfg');
        $router= new Router(
            $this->request,
            $this->response,
            $this->handler['index'],
            $this->handler['productGet'],
            $this->handler['productPost']
        );

        $router->route();
    }

    public function testWillRoutedToIndexGetWhenUriIsIndex(): void
    {
        $this->setRequest('get', '/index');

        $indexGetRequestHandler = $this->createMock(IndexGetRequestHandler::class);
        $indexGetRequestHandler->expects($this->once())->method('handle')->willReturn($this->response);
        $indexGetRequestHandler->expects($this->once())->method('getUrl')->willReturn($this->url);
        $indexGetRequestHandler->expects($this->once())->method('getMethod')->willReturn($this->method);

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
        $this->setRequest('get', '/product');

        $productGetRequestHandler = $this->createMock(ProductGetRequestHandler::class);
        $productGetRequestHandler->expects($this->once())->method('handle')->willReturn($this->response);
        $productGetRequestHandler->expects($this->once())->method('getUrl')->willReturn($this->url);
        $productGetRequestHandler->expects($this->once())->method('getMethod')->willReturn($this->method);

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
        $this->setRequest('post', '/product');

        $productPostRequestHandler = $this->createMock(ProductPostRequestHandler::class);
        $productPostRequestHandler->expects($this->once())->method('handle')->willReturn($this->response);
        $productPostRequestHandler->expects($this->once())->method('getUrl')->willReturn($this->url);
        $productPostRequestHandler->expects($this->once())->method('getMethod')->willReturn($this->method);

        $router = new Router(
            $this->request,
            $this->response,
            $this->handler['index'],
            $this->handler['productGet'],
            $productPostRequestHandler
        );

        $router->route();
    }

    private function setRequest(string $method, string $url): void
    {
        $this->request->expects($this->once())->method('method')->willReturn($method);
        $this->request->expects($this->once())->method('uri')->willReturn($url);
        $this->url->method('getString')->willReturn($url);
        $this->method->method('getString')->willReturn($method);
    }

}
