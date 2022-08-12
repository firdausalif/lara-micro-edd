<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * @mixin Builder
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
      'product_name',
      'product_price',
      'product_description'
    ];
}
