<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CustomerDetail extends Model
{
    use HasFactory;

    protected $table = "customer_detail";
    protected $fillable = ['phone','name','birthday','email'];

    public function customer_account()
    {
        return $this->belongsTo(CustomerAccount::class, 'Phone', 'Phone');
    }
}
