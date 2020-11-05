<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderTopping extends Model
{
    use HasFactory;

    protected $table = "order_topping";
    protected $fillable = ['id_order_product','id_topping','price_buy'];

}
