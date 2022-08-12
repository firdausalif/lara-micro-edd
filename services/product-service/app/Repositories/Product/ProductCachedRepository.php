<?php
namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;

class ProductCachedRepository implements ProductRepositoryInterface
{
    protected ProductRepositoryInterface $productRepository;
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function create(array $data): Product
    {
        Cache::forget("products");
        return $this->productRepository->create($data);
    }

    public function update(string $id, array $data): bool
    {
        Cache::forget("products");
        Cache::forget("product.{$id}");
        return $this->productRepository->update($id, $data);
    }

    public function find(string $id): Product
    {
        return Cache::remember("product.{$id}", 3600, function () use($id) {
            return $this->productRepository->find($id);
        });
    }

    public function get(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        return Cache::remember("products", 3600, function () {
            return $this->productRepository->get();
        });
    }

    public function delete(string $id): bool
    {
        Cache::forget("products");
        Cache::forget("product.{$id}");
        return $this->productRepository->delete($id);
    }

}
