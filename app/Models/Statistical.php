<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;

    protected $table = "statistical";

    public function product()
    {
        return $this->belongsTo(Product::class, 'Id_Product')
    }
}
