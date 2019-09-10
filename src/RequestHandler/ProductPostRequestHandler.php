<?php
declare(strict_types=1);

namespace Project\RequestHandler;

use Project\Http\Request;
use Project\Http\Response;
use Project\Repository\ProductRepository;
use Project\Values\Method;
use Project\Values\Url;
use Throwable;

class ProductPostRequestHandler implements RequestHandlerInterface
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function handle(Request $request, Response $response): Response
    {
        try {
            $this->productRepository->saveArray($request->request());
            $response->setBody(json_encode($this->productRepository->getAll(true)));
        } catch (Throwable $throwable) {
            error_log($throwable->getMessage());
            $response->setStatus(Response::SERVER_ERROR);
        }

        return $response;
    }

    public function getUrl(): Url
    {
        return new Url('/product');
    }

    public function getMethod(): Method
    {
        return new Method('post');
    }
}