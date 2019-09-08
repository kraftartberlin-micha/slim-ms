<?php declare(strict_types=1);

namespace Project\Tests\Unit;

use PHPUnit\Framework\TestCase;
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

}
