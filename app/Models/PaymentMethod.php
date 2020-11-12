<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $table = "payment_method";
    protected $primaryKey = 'Id';
    protected $fillable = ['name','status'];

    public function order()
    {
        return $this->hasMany(Order::class, 'Payment_Method');
    }
}
