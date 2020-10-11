<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";
    protected $primaryKey = 'Id';
    public $incrementing = true;
    protected $fillable = ['Name', 'Image', 'Description', 'Size', 'Price', 'Sale_Price', 'Visibility'];
    
    public function statistical()
    {
        return $this->hasOne(Statistical::class, 'Id_Product');
    }

    public function category()
    {
        return $this->belongsToMany(Category::class, 'product_category', 'Id_Product', 'Id_Category');
    }

    public function order()
    {
        return $this->belongsToMany(Order::class, 'order_product', 'Id_Product', 'Id_Order');
    }

}
