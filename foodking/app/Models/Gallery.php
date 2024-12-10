<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $table = 'product_gallery';
    protected $fillable = ['img', 'product_id'];

    public function products(){
      return  $this->belongsTo(Product::class);
    }
    
}