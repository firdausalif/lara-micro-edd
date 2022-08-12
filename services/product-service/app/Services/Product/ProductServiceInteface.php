<?php
namespace App\Services\Product;

use App\Http\Requests\Product\CreateProductRequest;
use App\Http\Requests\Product\UpdateProductRequest;
use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductServiceInteface {
    public function create(CreateProductRequest $request) : Product;
    public function update(string $id, UpdateProductRequest $request) : bool;
    public function find(string $id) : Product;
    public function get(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection;
    public function delete (string $id) : bool;
}
