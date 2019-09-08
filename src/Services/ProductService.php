<?php
declare(strict_types=1);

namespace Project\Services;

use Project\Repository\ProductRepository;

class ProductService
{
    /**
     * @var ProductRepository
     */
    private $productRepository;

    public function __construct(ProductRepository $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function getProducts(){
        return $this->productRepository->getAll();
    }

    public function saveProduct($array)
    {
        return $this->productRepository->save($array);
    }
}