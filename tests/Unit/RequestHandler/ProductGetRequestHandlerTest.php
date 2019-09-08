<?php declare(strict_types=1);

namespace Project\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\Services\ProductService;

/**
 * @covers \Project\RequestHandler\ProductGetRequestHandler
 */
class ProductGetRequestHandlerTest extends TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|Request
     */
    private $httpRequest;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|ProductService
     */
    private $productService;

    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|Response
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
        $this->httpResponse->expects($this->once())->method('getBody')->willReturn($this->testResponseString);

        $this->productService = $this->createMock(ProductService::class);
        $this->productService->expects($this->once())->method('getProducts')->willReturn('get');
    }

    public function testCanHandleRequest(): void
    {
        $productGetRequestHandler = new ProductGetRequestHandler($this->productService);
        $response = $productGetRequestHandler->handle($this->httpRequest, $this->httpResponse);
        TestCase::assertEquals($this->testResponseString, $response->getBody());
    }

}
