<?php declare(strict_types=1);

namespace Project\Tests\Unit\RequestHandler;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\Repository\ProductRepository;

/**
 * @covers \Project\RequestHandler\ProductGetRequestHandler
 */
class ProductGetRequestHandlerTest extends TestCase
{
    /**
     * @var MockObject|Request
     */
    private $httpRequest;

    /**
     * @var MockObject|ProductRepository
     */
    private $productRepository;

    /**
     * @var MockObject|Response
     */
    private $httpResponse;

    /**
     * @var string
     */
    private $testResponseString;

    public function setUp(): void
    {
        $this->testResponseString = 'test';
        $this->httpRequest = $this->createMock(Request::class);
        $this->httpResponse = $this->createMock(Response::class);
        $this->productRepository = $this->createMock(ProductRepository::class);
    }

    public function testCanHandleRequest(): void
    {
        $this->httpResponse->expects($this->once())->method('getBody')->willReturn($this->testResponseString);
        $this->productRepository->expects($this->once())->method('getAll')->willReturn([]);

        $productGetRequestHandler = new ProductGetRequestHandler($this->productRepository);
        $response = $productGetRequestHandler->handle($this->httpRequest, $this->httpResponse);
        TestCase::assertEquals($this->testResponseString, $response->getBody());
    }

    public function testHandleWithErrorsShouldSetErrorStatusCodeInResponse(): void
    {
        $this->productRepository->expects($this->once())->method('getAll')->willThrowException(new Exception());
        $this->httpResponse->expects($this->once())->method('setStatus')->with(500);

        $productGetRequestHandler = new ProductGetRequestHandler($this->productRepository);
        $productGetRequestHandler->handle($this->httpRequest, $this->httpResponse);
    }

    public function testCorrectUrl(){
        $productGetRequestHandler = new ProductGetRequestHandler($this->productRepository);
        TestCase::assertEquals('/product', $productGetRequestHandler->getUrl()->getString());
    }

    public function testCorrectMethod(){
        $productGetRequestHandler = new ProductGetRequestHandler($this->productRepository);
        TestCase::assertEquals('get', $productGetRequestHandler->getMethod()->getString());
    }

}
