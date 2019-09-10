<?php
declare(strict_types=1);

namespace Project\Values;

use Project\Exceptions\HandlerNotFoundException;
use Project\RequestHandler\RequestHandlerInterface;

class HandlerCollection
{
    /**
     * @var array
     */
    private $handlers;

    public function __construct(RequestHandlerInterface ...$args)
    {
        foreach ($args as $requestHandler) {
            $method = $requestHandler->getMethod()->getString();
            $url = $requestHandler->getUrl()->getString();
            if(!isset($this->handlers[$method][$url])){
                $this->handlers[$method][$url] = $requestHandler;
            }
        }
    }

    /**
     * @return array
     */
    public function getHandlers(): array
    {
        return $this->handlers;
    }

    /**
     * @throws HandlerNotFoundException
     */
    public function getHandler(Method $method, Url $url): RequestHandlerInterface
    {
        if (isset($this->handlers[$method->getString()][$url->getString()])) {
            return $this->handlers[$method->getString()][$url->getString()];
        }
        throw new HandlerNotFoundException('No handler found for : ' . $method->getString() . ' -- ' . $url->getString());
    }
}