<?php
declare(strict_types=1);

namespace Project\Values;

use Project\Exceptions\MethodIsEmptyException;

class Method
{
    /**
     * @var string
     */
    private $string;

    /**
     * @throws MethodIsEmptyException
     */
    public function __construct(string $string)
    {
        $this->ensureIsNotEmpty($string);
        $this->string = strtolower($string);
    }

    public function getString(): string
    {
        return $this->string;
    }

    /**
     * @throws MethodIsEmptyException
     */
    private function ensureIsNotEmpty(string $string)
    {
        if(empty(trim($string))){
            throw new MethodIsEmptyException('Method cant be empty!');
        }
    }
}