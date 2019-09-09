<?php declare(strict_types=1);

namespace Project\Tests\Unit\Http;

use PHPUnit\Framework\TestCase;
use Project\Exceptions\UnsupportedStatusCodeException;
use Project\Http\Response;

/**
 * @covers \Project\Http\Response
 */
class ResponseTest extends TestCase
{
    /**
     * @var Response
     */
    private $response;

    /**
     * @var string
     */
    private $testString;

    public function setUp(): void
    {
        $this->response = new Response();
        $this->testString = 'test<"/$';
    }

    public function testCanWriteAndGetBody(): void
    {
        $this->response->setBody($this->testString);
        TestCase::assertEquals($this->testString, $this->response->getBody());
    }

    public function testSetNonExistsStatusCodeShouldThrowException()
    {
        $this->expectException(UnsupportedStatusCodeException::class);
        $this->response->setStatus(1);
    }

    public function testCanSetAndGetExistsStatusCode()
    {
        $this->response->setStatus(500);
        TestCase::assertEquals(500, $this->response->getStatus());
    }

    public function testStatusCodeIsDefaultOk()
    {
        TestCase::assertEquals(200, $this->response->getStatus());
    }
}
