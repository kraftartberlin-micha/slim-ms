<?php declare(strict_types=1);

namespace Project\Tests\Unit\Values;

use PHPUnit\Framework\TestCase;
use Project\Exceptions\MethodIsEmptyException;
use Project\Values\Method;

/**
 * @covers \Project\Values\Method
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
