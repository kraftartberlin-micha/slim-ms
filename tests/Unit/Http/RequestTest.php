<?php declare(strict_types=1);

namespace Project\Tests\Unit;

use PHPUnit\Framework\TestCase;
use Project\Http\Request;
use RuntimeException;

/**
 * @covers \Project\Http\Request
 * @backupGlobals enabled
 */
class RequestTest extends TestCase
{

    /**
     * @var array
     */
    private $server;

    /**
     * @var array
     */
    private $serverWithoutAll;

    /**
     * @var array
     */
    private $serverWithoutMethod;

    /**
     * @var array
     */
    private $serverWithoutUri;

    /**
     * @var string
     */
    private $testUri;

    public function setUp(): void
    {
        $this->testUri = '/';
        $this->server = ['REQUEST_METHOD' => 'GET', 'REQUEST_URI' => $this->testUri];
        $this->serverWithoutAll = [];
        $this->serverWithoutMethod = ['REQUEST_URI' => $this->testUri];
        $this->serverWithoutUri = ['REQUEST_METHOD' => 'GET'];
    }

    public function testRequestCanBeCreatedWithoutErrors(): void
    {
        $_SERVER = $this->server;
        $httpRequest = new Request();
        TestCase::assertInstanceOf(Request::class, $httpRequest);
    }

    public function testRequestHasCorrectMethod(): void
    {
        $_SERVER = $this->server;
        $httpRequest = new Request();
        TestCase::assertEquals('GET', $httpRequest->method());
    }

    public function testRequestHasCorrectUri(): void
    {
        $_SERVER = $this->server;
        $httpRequest = new Request();
        TestCase::assertEquals($this->testUri, $httpRequest->uri());
    }

    public function testCanAccessRequestIfExists(): void
    {
        $_SERVER = $this->server;
        $_REQUEST['test'] = 1;
        $httpRequest = new Request();
        TestCase::assertEquals(1, $httpRequest->request()['test']);
    }

    public function testEmptyServerVarShouldThrowException(): void
    {
        $_SERVER = $this->serverWithoutAll;
        $this->expectException(RuntimeException::class);
        new Request();
    }

    public function testEmptyMethodShouldThrowException(): void
    {
        $_SERVER = $this->serverWithoutMethod;
        $this->expectException(RuntimeException::class);
        new Request();
    }

    public function testEmptyUriShouldThrowException(): void
    {
        $_SERVER = $this->serverWithoutUri;
        $this->expectException(RuntimeException::class);
        new Request();
    }

}
