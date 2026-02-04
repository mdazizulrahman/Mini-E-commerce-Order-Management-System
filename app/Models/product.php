<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
     protected $fillable = ['name', 'price', 'stock', 'category_id', 'status'];

    // Raelationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
