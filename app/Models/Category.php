<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name',
        'meta_denumire',
        'descriere',
        'tag'
    ];

    public function products(){
        return $this->hasMany(Product::class);
    }
}
