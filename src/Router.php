<?php
declare(strict_types=1);

namespace Project;

use Project\Http\Response;
use Project\Http\Request;
use Project\Http\Method;
use Project\Http\Url;
use Project\RequestHandler\RequestHandlerInterface;
use Project\RequestHandler\RequestHandlerCollection;

class Router
{
    /**
     * @var Request
     */
    private $request;

    /**
     * @var Response
     */
    private $response;

    /**
     * @var RequestHandlerCollection
     */
    private $requestHandlerCollection;

    public function __construct(
        Request $request,
        Response $response,
        RequestHandlerCollection $requestHandlerCollection
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->requestHandlerCollection = $requestHandlerCollection;
    }

    /**
     * @throws Exceptions\HandlerNotFoundException
     * @throws Exceptions\MethodIsEmptyException
     * @throws Exceptions\UrlIsEmptyException
     */
    public function route(): Response
    {
        return $this->getHandler()->handle($this->request, $this->response);
    }

    /**
     * @throws Exceptions\HandlerNotFoundException
     * @throws Exceptions\MethodIsEmptyException
     * @throws Exceptions\UrlIsEmptyException
     */
    private function getHandler(): RequestHandlerInterface
    {
        $method = new Method($this->request->method());
        $url = new Url($this->request->uri());
        return $this->requestHandlerCollection->getHandler($method, $url);
    }
}