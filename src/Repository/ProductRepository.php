<?php
declare(strict_types=1);

namespace Project\Repository;

use Project\Exceptions\ProductIdIsNegativeException;
use Project\Exceptions\ProductNameIsEmptyException;
use Project\Exceptions\ProductNotFoundException;
use Project\Exceptions\ProductPriceInCentsIsNegativeException;
use Project\Mapper\ProductArrayMapper;
use Project\Values\Product;
use function count;

/**
 * Stupid InMemoryTestRepository :D
 */
class ProductRepository
{
    /**
     * @var ProductArrayMapper
     */
    private $productArrayMapper;

    public function __construct(ProductArrayMapper $productArrayMapper)
    {
        $this->productArrayMapper = $productArrayMapper;
    }

    private $productsFakedFromDB = [
        ['id' => '1', 'name' => 'eyefon1', 'description' => 'description1', 'priceInCent' => '1150'],
        ['id' => '2', 'name' => 'eyefon2', 'description' => 'description2', 'priceInCent' => '2250'],
        ['id' => '3', 'name' => 'eyefon3', 'description' => 'description3', 'priceInCent' => '3350'],
    ];

    /**
     * @return mixed|Product
     * @throws ProductNameIsEmptyException
     * @throws ProductNotFoundException
     * @throws ProductPriceInCentsIsNegativeException
     * @throws ProductIdIsNegativeException
     */
    public function get(int $id, bool $asArray = false)
    {
        foreach ($this->productsFakedFromDB as $product) {
            if ($product['id'] == $id) {
                return $asArray ? $product : $this->productArrayMapper->mapArrayToObject($product);
            }
        }
        throw new ProductNotFoundException('No Product with this Id');
    }

    /**
     * @throws ProductIdIsNegativeException
     * @throws ProductNameIsEmptyException
     * @throws ProductPriceInCentsIsNegativeException
     */
    public function getAll(bool $asArray = false): array
    {
        $collection = [];
        foreach ($this->productsFakedFromDB as $product) {
            $collection[] = $asArray ? $product : $this->productArrayMapper->mapArrayToObject($product);
        }
        return $collection;
    }

    /**
     * @throws ProductNotFoundException
     */
    public function save(Product $product): void
    {
        if ($product->getProductId()->getInt() === 0) {
            $this->insert($product);
        } else {
            $this->update($product);
        }
    }

    /**
     * @throws ProductNameIsEmptyException
     * @throws ProductNotFoundException
     * @throws ProductPriceInCentsIsNegativeException
     * @throws ProductIdIsNegativeException
     */
    public function saveArray(array $array): void
    {
        $this->save($this->productArrayMapper->mapArrayToObject($array));
    }

    /**
     * @throws ProductNotFoundException
     */
    private function update(Product $product): void
    {
        foreach ($this->productsFakedFromDB as &$array) {
            if ($array['id'] == $product->getProductId()->getInt()) {
                $array = $this->productArrayMapper->mapObjectToArray($product);
                return;
            }
        }
        throw new ProductNotFoundException('Could not find Product for update');
    }

    private function insert(Product $product): void
    {
        $array = $this->productArrayMapper->mapObjectToArray($product);
        $array['id'] = count($this->productsFakedFromDB) + 1;
        $this->productsFakedFromDB[] = $array;
    }
}