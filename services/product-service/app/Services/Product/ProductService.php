<?php
namespace App\Services\Product;

use Exception;
use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ProductService implements ProductServiceInteface {
    protected ProductRepositoryInterface $productRepository;

    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * @throws Exception
     */
    public function create(CreateProductRequest $request): Product
    {
        try {
            $data = array(
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_description' => $request->product_description
            );

            return $this->productRepository->create($data);
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * @throws Exception
     */
    public function update(string $id, UpdateProductRequest $request): bool
    {
        DB::beginTransaction();
        try {
            $data = array(
                'product_name' => $request->product_name,
                'product_price' => $request->product_price,
                'product_description' => $request->product_description
            );
            $update = $this->productRepository->update($id, $data);
            if ($update) DB::commit();
            return $update;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception ($e->getMessage());
        }
    }

    public function find(string $id): Product
    {
        return $this->productRepository->find($id);
    }

    public function get(string $order = 'id', string $sort = 'desc', array $columns = ['*']): Collection
    {
        $key = "products";
        $products = Cache::get($key);
        if ($products) {
            return $products;
        }
        return $this->productRepository->get();
    }

    /**
     * @throws Exception
     */
    public function delete(string $id): bool
    {
        DB::beginTransaction();
        try {
            $delete = $this->productRepository->delete($id);
            if ($delete) DB::commit();
            return $delete;
        } catch (Exception $e) {
            DB::rollBack();
            throw new Exception ($e->getMessage());
        }
    }
}
