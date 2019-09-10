<?php declare(strict_types=1);

namespace Project\Tests\Unit\RequestHandler;

use PHPUnit\Framework\MockObject\MockObject;
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
     * @var MockObject|Request
     */
    private $httpRequest;

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
    }

    public function testCanHandleRequest(): void
    {
        $this->httpResponse->expects($this->once())->method('getBody')->willReturn($this->testResponseString);
        $indexGetRequestHandler = new IndexGetRequestHandler();
        $response = $indexGetRequestHandler->handle($this->httpRequest, $this->httpResponse);
        TestCase::assertEquals($this->testResponseString, $response->getBody());
    }

    public function testCorrectUrl(){
        $indexGetRequestHandler = new IndexGetRequestHandler();
        TestCase::assertEquals('/', $indexGetRequestHandler->getUrl()->getString());
    }

    public function testCorrectMethod(){
        $indexGetRequestHandler = new IndexGetRequestHandler();
        TestCase::assertEquals('get', $indexGetRequestHandler->getMethod()->getString());
    }

}
