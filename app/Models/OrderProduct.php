<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = "order_product";
    protected $primaryKey = 'Id';
    protected $fillable = ['id_product_size','id_order','price_buy'];

    // Get total price of product item (product price + toppings price)
    public function getTotalPriceAttribute()
    {
        return $this->Price_Buy + $this->toppingsTotal;
    }

    // Get total price of toppings
    public function getToppingsTotalAttribute()
    {
        return (int)$this->topping()->sum('topping.Price');
    }

    public function topping()
    {
        return $this->belongsToMany(Topping::class, 'order_topping', 'Id_Order_Product', 'Id_Topping');
    }

    public function attribute()
    {
        return $this->hasOne(Attribute::class, 'Id_Order_Product');
    }


}
