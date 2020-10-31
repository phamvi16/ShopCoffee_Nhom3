<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerAccount extends Model
{
    use HasFactory;

    protected $table = "customer_account";
    protected $fillable = ['phone','password'];

    public function customer_detail()
    {
        return $this->hasOne(CustomerDetail::class, 'Phone');
    }

    public function loyalty()
    {
        return $this->hasOne(Loyalty::class, 'Phone');
    }

    public function customer_shipping()
    {
        return $this->hasMany(CustomerShipping::class, 'Phone', 'Phone');
    }
}
