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
     * @var IndexGetRequestHandler
     */
    private $indexGetRequestHandler;

    /**
     * @var ProductGetRequestHandler
     */
    private $productGetRequestHandler;

    /**
     * @var ProductPostRequestHandler
     */
    private $productPostRequestHandler;

    /**
     * @var Response
     */
    private $response;

    public function __construct(
        Request $request,
        Response $response,
        IndexGetRequestHandler $indexGetRequestHandler,
        ProductGetRequestHandler $productGetRequestHandler,
        ProductPostRequestHandler $productPostRequestHandler
    ) {
        $this->request = $request;
        $this->response = $response;
        $this->indexGetRequestHandler = $indexGetRequestHandler;
        $this->productGetRequestHandler = $productGetRequestHandler;
        $this->productPostRequestHandler = $productPostRequestHandler;
    }

    public function route(): Response
    {
        $handler = $this->getHandler();
        return $handler->handle($this->request, $this->response);
    }

    private function getHandler(): RequestHandlerInterface
    {
        /**
         * @todo: first draw, should be refactored, maybe dynamic with configfile?
         */
        $selected = null;
        if (strpos(strtolower($this->request->uri()), 'product')!== false) {
            switch (strtolower($this->request->method())) {
                case 'post':
                    $selected = $this->productPostRequestHandler;
                    break;
                case 'get':
                default:
                    $selected = $this->productGetRequestHandler;
                    break;
            }
        } else {
            $selected = $this->indexGetRequestHandler;
        }
        return $selected;
    }
}