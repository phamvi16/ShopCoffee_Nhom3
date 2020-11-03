<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Statistical extends Model
{
    use HasFactory;

    protected $table = "statistical";
    protected $primaryKey = 'Id_Product';
    public $incrementing = true;
    protected $fillable = ['Id_Product', 'Purchase'];

    public function product()
    {
        return $this->belongsTo(Product::class, 'Id_Product');
    }
}
