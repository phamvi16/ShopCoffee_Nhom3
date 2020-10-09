<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topping extends Model
{
    use HasFactory;

    protected $table = "topping";

    public function order()
    {
        return $this->belongsToMany(OrderProduct::class, 'order_topping', 'Id_Topping', 'Id_Order_Product');
    }
}
