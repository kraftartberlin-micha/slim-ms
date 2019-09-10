<?php declare(strict_types=1);

namespace Project\Tests\Unit\Http;

use PHPUnit\Framework\TestCase;
use Project\Exceptions\MethodIsEmptyException;
use Project\Http\Method;

/**
 * @covers \Project\Http\Method
 */
class MethodTest extends TestCase
{
    public function testCanCreateAndGetMethod(): void
    {
        $string = 'search';
        $method =new Method($string);
        TestCase::assertEquals($string, $method->getString());
    }

    public function testEmptyStringShouldThrowException(): void
    {
        $this->expectException(MethodIsEmptyException::class);
        new Method('');
    }

    public function testOnlyWhitespaceShouldThrowException(): void
    {
        $this->expectException(MethodIsEmptyException::class);
        new Method(' ');
    }

}
