<?php
declare(strict_types=1);

namespace Project\Repository;

use Project\Mapper\ProductArrayMapper;
use Project\Values\Product;
use Project\Values\ProductDescription;
use Project\Values\ProductId;
use Project\Values\ProductName;
use Project\Values\ProductPrice;
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

    public function get(int $id, bool $asArray = false): Product
    {
        foreach ($this->productsFakedFromDB as $product) {
            if ($product['id'] == $id) {
                return $asArray ? $product : $this->productArrayMapper->mapArrayToObject($product);
            }
        }
    }

    public function getAll(bool $asArray = false): array
    {
        $collection = [];
        foreach ($this->productsFakedFromDB as $product) {
            $collection[] = $asArray ? $product : $this->productArrayMapper->mapArrayToObject($product);
        }
        return $collection;
    }

    public function save(Product $product): void
    {
        if ($product->getProductId()->getNumber() === 0) {
            $this->insert($product);
        } else {
            $this->update($product);
        }
    }

    public function saveArray(array $array): void
    {
        $this->save($this->productArrayMapper->mapArrayToObject($array));
    }

    private function update(Product $product): void
    {
        foreach ($this->productsFakedFromDB as &$array) {
            if ($array['id'] === $product->getProductId()->getNumber()) {
                $this->productArrayMapper->mapObjectToArray($product);
                return;
            }
        }
        $this->insert($product);
    }

    private function insert(Product $product): void
    {
        $array = $this->productArrayMapper->mapObjectToArray($product);
        $array['id'] = count($this->productsFakedFromDB) + 1;
        $this->productsFakedFromDB[] = $array;
    }
}