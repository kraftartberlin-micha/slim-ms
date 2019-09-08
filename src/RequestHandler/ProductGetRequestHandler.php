<?php
declare(strict_types=1);

namespace Project\RequestHandler;

use Project\Http\Request;
use Project\Http\Response;
use Project\Services\ProductService;

class ProductGetRequestHandler implements RequestHandlerInterface
{
    /**
     * @var ProductService
     */
    private $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function handle(Request $request, Response $response):Response
    {
        $response->setBody($this->productService->getProducts());
        return $response;
    }
}