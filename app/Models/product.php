<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class product extends Model
{
     protected $fillable = ['name', 'price', 'stock', 'category_id', 'status'];

    // Eloquent relationships
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
