<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'detail', 'price_regular', 'price_sale', 'quantity', 'sku', 'slug', 'description', 'more_details', 'img_thumbnail'];
    protected $casts = [
        'is_active' => 'boolean',
        'is_show_home' => 'boolean',
    ];

    public function categories()
    {
        $this->belongsTo(Category::class);
    }
}
