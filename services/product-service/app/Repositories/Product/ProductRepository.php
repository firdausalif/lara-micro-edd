<?php
namespace App\Repositories\Product;

use App\Exceptions\Product\CreateProductErrorException;
use App\Exceptions\Product\ProductNotFoundException;
use App\Models\Product;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Database\QueryException;
use Illuminate\Support\Collection;

class ProductRepository implements ProductRepositoryInterface {
    protected Product $product;

    public function __construct(Product $product)
    {
        $this->product = $product;
    }

    /**
     * @throws CreateProductErrorException
     */
    public function create(array $data): Product
    {
        try {
            return $this->product->create($data);
        } catch (QueryException $e) {
            throw new CreateProductErrorException("Failed to create product");
        }
    }

    public function update(string $id, array $data): bool
    {
        return $this->product->where('id', $id)->update($data);
    }

    /**
     * @throws ProductNotFoundException
     */
    public function find(string $id): Product
    {
        try {
            return $this->product->find($id);
        } catch (ModelNotFoundException $e) {
            throw new ProductNotFoundException("Product Not Found");
        }
    }

    public function get(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        return $this->product->all($columns, $order, $sort);
    }

    public function delete(string $id): bool
    {
        return $this->product->where('id', $id)->delete();
    }

}
