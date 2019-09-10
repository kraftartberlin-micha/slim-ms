<?php
declare(strict_types=1);

namespace Project\Http;

use Project\Exceptions\UnsupportedStatusCodeException;

class Response
{
    const HTTP_OK = 200;
    const NO_CONTENT = 204;
    const SERVER_ERROR = 500;
    /**
     * @var string
     */
    private $body = '';

    /**
     * @var array
     */
    private $supportedCodes = [
        self::HTTP_OK,
        self::NO_CONTENT,
        self::SERVER_ERROR,
    ];

    /**
     * @var int
     */
    private $status = self::HTTP_OK;

    public function setBody(string $content):void
    {
        $this->body = $content;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    /**
     * @throws UnsupportedStatusCodeException
     */
    public function setStatus(int $status)
    {
        if(!in_array($status, $this->supportedCodes)){
            throw new UnsupportedStatusCodeException($status.'-Statuscode is not supported');
        }
        $this->status = $status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }
}