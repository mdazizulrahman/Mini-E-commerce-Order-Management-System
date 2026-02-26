<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = [
        'order_id',
        'tran_id',
        'user_id',
        'amount',
        'currency',
        'status',
        'transaction_id',
        'payment_method',
        'val_id',
    ];
    public function order()
    {
        return $this->belongsTo(order::class);
    }
}
