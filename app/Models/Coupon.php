<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;

    protected $table = "coupon";
    protected $primaryKey = 'Id';
    //public $incrementing = true;
    protected $fillable = ['Id', 'Type', 'Value', 'Description', 'Started_at', 'Ended_at'];

    public function order()
    {
        return $this->hasMany(Order::class, 'Coupon');
    }
}
