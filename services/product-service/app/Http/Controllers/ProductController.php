<?php

namespace App\Http\Controllers;

use App\Http\Requests\Product\CreateProductRequest;
use App\Services\Product\ProductServiceInteface;
use Exception;

class ProductController extends Controller
{
    //
    protected ProductServiceInteface $productService;

    public function __construct(ProductServiceInteface $productService)
    {
        $this->productService = $productService;
    }

    public function store(CreateProductRequest $request) {
        try {
            $product = $this->productService->create($request);
            return $this->success("Success create product", $product);
        } catch (Exception $e) {
            return $this->failure($e->getMessage());
        }
    }

    public function list() {
        $products = $this->productService->get();
        return $this->success("List Products", $products);
    }
}
