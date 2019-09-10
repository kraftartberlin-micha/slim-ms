<?php
declare(strict_types=1);

namespace Project;

use Project\Http\Response;
use Project\Http\Request;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\RequestHandler\RequestHandlerInterface;
use Project\Values\HandlerCollection;
use Project\Values\Method;
use Project\Values\Url;

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
     * @var HandlerCollection
     */
    private $handlerCollection;

    public function __construct(
        Request $request,
        Response $response,
        IndexGetRequestHandler $indexGetRequestHandler,
        ProductGetRequestHandler $productGetRequestHandler,
        ProductPostRequestHandler $productPostRequestHandler
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->handlerCollection = new HandlerCollection(
            $indexGetRequestHandler,
            $productGetRequestHandler,
            $productPostRequestHandler
        );
    }

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
        return $this->handlerCollection->getHandler($method, $url);
    }
}