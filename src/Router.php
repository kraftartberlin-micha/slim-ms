<?php
declare(strict_types=1);

namespace Project;

use Project\Http\Response;
use Project\Http\Request;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\RequestHandler\RequestHandlerInterface;

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
     * @var array
     */
    private $handler;

    /**
     * @var RequestHandlerInterface
     */
    private $defaultRequestHandler;

    public function __construct(
        Request $request,
        Response $response,
        IndexGetRequestHandler $indexGetRequestHandler,
        ProductGetRequestHandler $productGetRequestHandler,
        ProductPostRequestHandler $productPostRequestHandler
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->registerHandler('get', '/index', $indexGetRequestHandler, true);
        $this->registerHandler('get', '/product', $productGetRequestHandler);
        $this->registerHandler('post', '/product', $productPostRequestHandler);
    }

    public function route(): Response
    {
        return $this->getHandler()->handle($this->request, $this->response);
    }

    /**
     * @return mixed|RequestHandlerInterface
     */
    private function getHandler()
    {
        $method = strtolower($this->request->method());
        $uri = strtolower($this->request->uri());
        $paramsPos = strpos($uri, '?');
        $action = $paramsPos === false ? $uri : substr($uri, 0, $paramsPos);
        return $this->handler[$method][$action] ?? $this->defaultRequestHandler;
    }

    private function registerHandler($method, $uri, RequestHandlerInterface $requestHandler, bool $isDefault = false): void
    {
        $this->handler[strtolower($method)][strtolower($uri)] = $requestHandler;
        if ($isDefault) {
            $this->defaultRequestHandler = $requestHandler;
        }
    }
}