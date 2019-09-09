<?php
declare(strict_types=1);

namespace Project\RequestHandler;

use Project\Http\Request;
use Project\Http\Response;
use Project\Repository\ProductRepository;

class ProductGetRequestHandler implements RequestHandlerInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(Request $request, Response $response):Response
    {
        $response->setBody(json_encode($this->productRepository->getAll(true)));
        return $response;
    }
}