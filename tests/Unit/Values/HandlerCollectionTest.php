<?php declare(strict_types=1);

namespace Project\Tests\Unit\Values;

use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Project\Exceptions\HandlerNotFoundException;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\RequestHandler\RequestHandlerInterface;
use Project\Values\HandlerCollection;
use Project\Values\Method;
use Project\Values\Url;

/**
 * @covers \Project\Values\HandlerCollection
 */
class HandlerCollectionTest extends TestCase
{
    /**
     * @var MockObject|ProductPostRequestHandler|RequestHandlerInterface
     */
    private $productPostRequestHandler;

    /**
     * @var MockObject|IndexGetRequestHandler|RequestHandlerInterface
     */
    private $indexGetRequestHandler;

    /**
     * @var HandlerCollection
     */
    private $collection;

    public function setUp(): void
    {
        $this->indexGetRequestHandler = $this->createMock(IndexGetRequestHandler::class);
        $this->indexGetRequestHandler = $this->setUrlAndMethod('get', '/', $this->indexGetRequestHandler);

        $this->productPostRequestHandler = $this->createMock(ProductPostRequestHandler::class);
        $this->productPostRequestHandler = $this->setUrlAndMethod('post', '/product', $this->productPostRequestHandler);

        $this->collection = new HandlerCollection($this->indexGetRequestHandler, $this->productPostRequestHandler);
    }

    public function testCanFillHandlerCollectionAndGetAll(): void
    {
        TestCase::assertCount(2, $this->collection->getHandlers());
    }

    public function testCanFillHandlerCollectionAndFindOneSpecial(): void
    {
        $urlMock = $this->createMock(Url::class);
        $urlMock->method('getString')->willReturn('/product');
        $methodMock = $this->createMock(Method::class);
        $methodMock->method('getString')->willReturn('post');
        $response = $this->collection->getHandler($methodMock, $urlMock);
        TestCase::assertEquals('/product', $response->getUrl()->getString());
    }

    public function testUnknownHandlerShouldThrowException(): void
    {
        $this->expectException(HandlerNotFoundException::class);
        $urlMock = $this->createMock(Url::class);
        $urlMock->method('getString')->willReturn('/abc');
        $methodMock = $this->createMock(Method::class);
        $methodMock->method('getString')->willReturn('post');
        $this->collection->getHandler($methodMock, $urlMock);
    }

    /**
     * @param string $method
     * @param string $url
     * @param MockObject|RequestHandlerInterface $requestHandler
     * @return MockObject|RequestHandlerInterface
     */
    private function setUrlAndMethod(
        string $method,
        string $url,
        $requestHandler
    ) {

        $urlMock = $this->createMock(Url::class);
        $urlMock->method('getString')->willReturn($url);
        $requestHandler->method('getUrl')->willReturn($urlMock);

        $methodMock = $this->createMock(Method::class);
        $methodMock->method('getString')->willReturn($method);
        $requestHandler->method('getMethod')->willReturn($methodMock);
        return $requestHandler;
    }
}
