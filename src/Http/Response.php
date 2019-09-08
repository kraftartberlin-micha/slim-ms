<?php
declare(strict_types=1);

namespace Project\Http;

class Response
{
    /**
     * @var string
     */
    private $body = '';

    public function setBody(string $content):void
    {
        $this->body = $content;
    }

    public function getBody(): string
    {
        return $this->body;
    }
}