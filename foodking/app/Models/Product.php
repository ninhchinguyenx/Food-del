<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'detail', 'category_id', 'price_regular', 'price_sale', 'quantity', 'sku', 'slug', 'description', 'more_details', 'img_thumbnail', 'is_show_home','is_active'];
    protected $casts = [
        'is_active' => 'boolean',
        'is_show_home' => 'boolean',
    ];

    public function category()
    {
       return $this->belongsTo(Category::class);
    }

    public function product_gallery(){
        return $this->hasMany(Gallery::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class);
    }

}
