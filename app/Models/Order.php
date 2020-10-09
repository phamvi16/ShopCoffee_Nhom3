<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "order";

    public function product()
    {
        return $this->belongsToMany(Product::class, 'order_product', 'Id_Order', 'Id_Product');
    }

    public function customer_shipping()
    {
        return $this->belongsTo(CustomerShipping::class, 'Customer');
    }

    public function payment_method()
    {
        return $this->belongsTo(PaymentMethod::class, 'Payment_Method');
    }

    public function coupon()
    {
        return $this->belongsTo(Coupon::class, 'Coupon');
    }
}
