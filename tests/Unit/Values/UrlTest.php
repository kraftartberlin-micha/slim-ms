<?php declare(strict_types=1);

namespace Project\Tests\Unit\Values;

use PHPUnit\Framework\TestCase;
use Project\Exceptions\UrlIsEmptyException;
use Project\Values\Url;

/**
 * @covers \Project\Values\Url
 */
class UrlTest extends TestCase
{
    public function testCanCreateAndGetUrl(): void
    {
        $string = 'search';
        $url =new Url($string);
        TestCase::assertEquals($string, $url->getString());
    }

    public function testCanCreateAndGetUrlWithArgs(): void
    {
        $args = '?t=1';
        $string = 'search';
        $urlString = $string.$args;
        $url =new Url($urlString);
        TestCase::assertEquals($string, $url->getString());
        TestCase::assertEquals($args, $url->getStringArgs());
    }

    public function testEmptyStringShouldThrowException(): void
    {
        $this->expectException(UrlIsEmptyException::class);
        new Url('');
    }

    public function testOnlyWhitespaceShouldThrowException(): void
    {
        $this->expectException(UrlIsEmptyException::class);
        new Url(' ');
    }

}
