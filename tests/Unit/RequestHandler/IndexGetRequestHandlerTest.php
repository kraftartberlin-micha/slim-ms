<?php declare(strict_types=1);

namespace Project\Tests\Unit\RequestHandler;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\RequestHandler\IndexGetRequestHandler;

/**
 * @covers \Project\RequestHandler\IndexGetRequestHandler
 */
class IndexGetRequestHandlerTest extends TestCase
{
    /**
     * @var \PHPUnit\Framework\MockObject\MockObject|Request
     */
    private $httpRequest;

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
    }

    public function testCanHandleRequest(): void
    {
        $indexGetRequestHandler = new IndexGetRequestHandler();
        $response = $indexGetRequestHandler->handle($this->httpRequest, $this->httpResponse);
        TestCase::assertEquals($this->testResponseString, $response->getBody());
    }

}
