<?php
declare(strict_types=1);

namespace Project\Http;

use Project\Exceptions\UrlIsEmptyException;

class Url
{
    /**
     * @var string
     */
    private $string;
    /**
     * @var bool|string
     */
    private $stringArgs;

    /**
     * @throws UrlIsEmptyException
     */
    public function __construct(string $string)
    {
        $this->ensureIsNotEmpty($string);
        $this->string = $string;
        $this->excludeArgs();
    }

    public function getString(): string
    {
        return $this->string;
    }

    /**
     * @throws UrlIsEmptyException
     */
    private function ensureIsNotEmpty(string $string)
    {
        if(empty(trim($string))){
            throw new UrlIsEmptyException('Url cant be empty!');
        }
    }

    private function excludeArgs():void
    {
        $string = $this->string;
        $paramsPos = strpos($string, '?');
        $this->string = $paramsPos === false ? $string : substr($string, 0, $paramsPos);
        $this->stringArgs = $paramsPos === false ?: substr($string, $paramsPos);
    }

    /**
     * @return bool|string
     */
    public function getStringArgs()
    {
        return $this->stringArgs;
    }
}