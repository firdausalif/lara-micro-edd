<?php

namespace App\Providers;

use App\Models\Product;
use App\Repositories\Product\ProductCachedRepository;
use App\Repositories\Product\ProductRepository;
use App\Repositories\Product\ProductRepositoryInterface;
use Illuminate\Support\ServiceProvider;

class RepositoriesProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(ProductRepositoryInterface::class, function ($app) {
            return new ProductCachedRepository(
                new ProductRepository($app->make(Product::class))
            );
        });
    }


    public function provides()
    {
        return [
            ProductRepositoryInterface::class,
        ];
    }
}
