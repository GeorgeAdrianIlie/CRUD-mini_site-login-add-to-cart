<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [ 
        "name", 
        "meta_description", 
        "price", 
        "VAT", 
        "description", 
        "availability", 
        "category_id", 
        "image", 
        "tag"
    ];

    public function category()
    {
        return $this->belongsTo(Category::class,"category_id");
    }

}
