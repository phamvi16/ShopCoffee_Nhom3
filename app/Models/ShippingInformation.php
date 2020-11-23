<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingInformation extends Model
{
    use HasFactory;

    protected $table = "shipping_information";
    protected $primaryKey = 'Id';
    public $incrementing = true;
    protected $fillable = ['name', 'phone', 'email', 'address', 'created_at', 'updated_at'];
    public function customer_shipping()
    {
        return $this->hasOne(CustomerShipping::class, 'Id_Shipping');
    }
}
