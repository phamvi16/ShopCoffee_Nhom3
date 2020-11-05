<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerShipping extends Model
{
    use HasFactory;

    protected $table = "customer_shipping";
    protected $primaryKey = 'Id';
    public $incrementing = true;
    protected $fillable = ['phone','id_shipping'];
    public function order()
    {
        return $this->hasMany(Order::class, 'Customer');
    }

    public function shipping_information()
    {
        return $this->belongsTo(ShippingInformation::class, 'Id_Shipping');
    }

    public function customer_account()
    {
        return $this->belongsTo(CustomerAccount::class, 'Phone', 'Phone');
    }
}
