<?php
declare(strict_types=1);

namespace Project;

use Project\Http\Request;
use Project\Http\Response;
use Project\Product\Mapper\ProductArrayMapper;
use Project\Product\Adapter\ProductAdapter;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\RequestHandler\RequestHandlerCollection;

class Factory
{
    public function productPostRequestHandler(): ProductPostRequestHandler
    {
        return new ProductPostRequestHandler($this->productRepository());
    }

    public function productGetRequestHandler(): ProductGetRequestHandler
    {
        return new ProductGetRequestHandler($this->productRepository());
    }

    public function productRepository(): ProductAdapter
    {
        return new ProductAdapter($this->productArrayMapper());
    }

    public function productArrayMapper(): ProductArrayMapper
    {
        return new ProductArrayMapper();
    }

    public function indexGetRequestHandler(): IndexGetRequestHandler
    {
        return new IndexGetRequestHandler();
    }

    public function request(): Request
    {
        return new Request();
    }

    public function response(): Response
    {
        return new Response();
    }

    public function router(): Router
    {
        return new Router(
            $this->request(),
            $this->response(),
            $this->requestHandlerCollection()
        );
    }

    public function requestHandlerCollection(): RequestHandlerCollection
    {
        return new RequestHandlerCollection(
            $this->indexGetRequestHandler(),
            $this->productGetRequestHandler(),
            $this->productPostRequestHandler()
        );
    }


}