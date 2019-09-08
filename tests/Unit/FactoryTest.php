<?php declare(strict_types=1);

namespace Project\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Project\Factory;
use Project\Http\Request;
use Project\Http\Response;
use Project\Router;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\RequestHandler\RequestHandlerInterface;

/**
 * @covers \Project\Factory
 * @backupGlobals enabled
 */
class FactoryTest extends TestCase
{
    /**
     * @var Factory
     */
    private $factory;

    public function setUp(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => '/'];
        $this->factory = new Factory();
    }

    public function testProductPostRequestHandlerCanBeCreated(): void
    {
        $productPostRequestHandler = $this->factory->productPostRequestHandler();
        TestCase::assertInstanceOf(ProductPostRequestHandler::class, $productPostRequestHandler);
    }

    public function testProductGetRequestHandlerCanBeCreated(): void
    {
        $productGetRequestHandler = $this->factory->productGetRequestHandler();
        TestCase::assertInstanceOf(ProductGetRequestHandler::class, $productGetRequestHandler);
    }

    public function testIndexGetRequestHandlerCanBeCreated(): void
    {
        $indexGetRequestHandler = $this->factory->indexGetRequestHandler();
        TestCase::assertInstanceOf(IndexGetRequestHandler::class, $indexGetRequestHandler);
    }

    public function testAllRequestHandlerHasCorrectInterface(): void
    {
        TestCase::assertInstanceOf( RequestHandlerInterface::class, $this->factory->productPostRequestHandler());
        TestCase::assertInstanceOf( RequestHandlerInterface::class, $this->factory->productGetRequestHandler());
        TestCase::assertInstanceOf( RequestHandlerInterface::class, $this->factory->indexGetRequestHandler());
    }

    public function testRequestCanBeCreated(): void
    {
        $request = $this->factory->request();
        TestCase::assertInstanceOf(Request::class, $request);
    }
    public function testResponseCanBeCreated(): void
    {
        $response = $this->factory->response();
        TestCase::assertInstanceOf(Response::class, $response);
    }

    public function testRequestHandlerCanBeCreated(): void
    {
        $requestHandler = $this->factory->requestHandler();
        TestCase::assertInstanceOf(Router::class, $requestHandler);
    }

}
