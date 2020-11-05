<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;

    protected $table = "attribute";
    protected $fillable = ['id_order_product','sugar','ice','hot'];

    public function order_product()
    {
        return $this->belongsTo(OrderProduct::class, 'Id_Order_Product');
    }
}
