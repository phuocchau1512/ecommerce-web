<?php

// app/Models/Product.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'category_id',
        'name',
        'material',
        'size',
        'color',
        'origin',
        'description',
        'image'
    ];

    public function variants()
    {
        return $this->hasMany(ProductVariant::class, 'product_id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class);
    }

    public function getMinPriceAttribute()
    {
        return $this->variants()->min('price');
    }

}
