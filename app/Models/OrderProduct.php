<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderProduct extends Model
{
    use HasFactory;

    protected $table = "order_product";

    public function topping()
    {
        return $this->belongsToMany(Topping::class, 'order_topping', 'Id_Order_Product', 'Id_Topping');
    }

    public function attribute()
    {
        return $this->hasOne(Attribute::class, 'Id_Order_Product');
    }


}
