<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BasketOrder extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'basket_id',
        'order_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }

}
