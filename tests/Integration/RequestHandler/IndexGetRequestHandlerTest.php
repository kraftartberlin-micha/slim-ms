<?php declare(strict_types=1);

namespace Project\Tests\Integration;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use Project\Http\Response;
use Project\RequestHandler\IndexGetRequestHandler;

/**
 * @covers \Project\RequestHandler\IndexGetRequestHandler
 * @backupGlobals enabled
 */
class IndexGetRequestHandlerTest extends TestCase
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    public function setUp(): void
    {
        $_SERVER = ['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => 'index'];
        $this->testResponseString = 'test';
        $this->request = new Request();
        $this->response = new Response();
    }

    public function testCanHandleRequest(): void
    {
        $indexGetRequestHandler = new IndexGetRequestHandler();
        $response = $indexGetRequestHandler->handle($this->request, $this->response);
        TestCase::assertEquals('index', $response->getBody());
    }

}
