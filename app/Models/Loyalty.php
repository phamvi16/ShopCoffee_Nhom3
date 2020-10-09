<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loyalty extends Model
{
    use HasFactory;

    protected $table = "loyalty";

    public function customer_account()
    {
        return $this->belongsTo(CustomerAccount::class, 'Phone', 'Phone');
    }
}
