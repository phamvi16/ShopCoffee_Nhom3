<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "category";
    protected $primaryKey = 'Id';
    public $incrementing = true;
    protected $fillable = ['Name', 'Image', 'Count'];

    public function product()
    {
        return $this->belongsToMany(Product::class, 'product_category', 'Id_Category', 'Id_Product');
    }
}
