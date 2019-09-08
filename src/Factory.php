<?php
declare(strict_types=1);

namespace Project;

use Project\Http\Request;
use Project\Http\Response;
use Project\Repository\ProductRepository;
use Project\RequestHandler\IndexGetRequestHandler;
use Project\RequestHandler\ProductGetRequestHandler;
use Project\RequestHandler\ProductPostRequestHandler;
use Project\Services\ProductService;

class Factory
{
    public function productPostRequestHandler(): ProductPostRequestHandler
    {
        return new ProductPostRequestHandler($this->productService());
    }

    public function productGetRequestHandler(): ProductGetRequestHandler
    {
        return new ProductGetRequestHandler($this->productService());
    }

    public function productService(): ProductService
    {
        return new ProductService($this->productRepository());
    }

    public function productRepository(): ProductRepository
    {
        return new ProductRepository();
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

    public function requestHandler() :Router
    {
        return new Router(
            $this->request(),
            $this->response(),
            $this->indexGetRequestHandler(),
            $this->productGetRequestHandler(),
            $this->productPostRequestHandler()
        );
    }
}