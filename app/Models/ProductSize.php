<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductSize extends Model
{
    use HasFactory;

    protected $table = "product_size";

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'Id_Product_Size', 'Id_Order');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'Id_Product');
    }
}
