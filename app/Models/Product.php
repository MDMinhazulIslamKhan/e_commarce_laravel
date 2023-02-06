<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_name',
        'product_short_des',
        'product_long_des',
        'price',
        'category_name',
        'subcategory_name',
        'category_id',
        'subcategory_id',
        'image',
        'slug'
    ];
}
