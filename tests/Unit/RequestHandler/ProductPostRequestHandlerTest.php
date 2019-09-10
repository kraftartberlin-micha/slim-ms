<?php declare(strict_types=1);

namespace Project\Tests\Unit\RequestHandler;

use Exception;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\Product\Adapter\ProductAdapter;

/**
 * @covers \Project\RequestHandler\ProductPostRequestHandler
 */
class ProductPostRequestHandlerTest extends TestCase
{
    /**
     * @var MockObject|Request
     */
    private $httpRequest;

    /**
     * @var MockObject|ProductAdapter
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

        $this->productRepository = $this->createMock(ProductAdapter::class);
    }

    public function testCanHandleRequest(): void
    {
        $this->httpResponse->expects($this->once())->method('getBody')->willReturn($this->testResponseString);
        $this->productRepository->expects($this->once())->method('saveArray');

        $productPostRequestHandler = new ProductPostRequestHandler($this->productRepository);
        $response = $productPostRequestHandler->handle($this->httpRequest, $this->httpResponse);
        TestCase::assertEquals($this->testResponseString, $response->getBody());
    }


    public function testHandleWithErrorsShouldSetErrorStatusCodeInResponse(): void
    {
        $this->productRepository->expects($this->once())->method('saveArray')->willThrowException(new Exception());
        $this->httpResponse->expects($this->once())->method('setStatus')->with(500);

        $productGetRequestHandler = new ProductPostRequestHandler($this->productRepository);
        $productGetRequestHandler->handle($this->httpRequest, $this->httpResponse);
    }

    public function testCorrectUrl(){
        $productGetRequestHandler = new ProductPostRequestHandler($this->productRepository);
        TestCase::assertEquals('/product', $productGetRequestHandler->getUrl()->getString());
    }

    public function testCorrectMethod(){
        $productPostRequestHandler = new ProductPostRequestHandler($this->productRepository);
        TestCase::assertEquals('post', $productPostRequestHandler->getMethod()->getString());
    }
}
