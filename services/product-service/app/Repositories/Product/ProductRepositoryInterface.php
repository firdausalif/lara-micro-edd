<?php
namespace App\Repositories\Product;

use App\Models\Product;
use Illuminate\Support\Collection;

interface ProductRepositoryInterface {
    public function create(array $data) : Product;
    public function update(string$id, array $data) : bool;
    public function find(string $id) : Product;
    public function get(string $order = 'id', string $sort = 'desc', array $columns = ['*']) : Collection;
    public function delete (string $id) : bool;
}
