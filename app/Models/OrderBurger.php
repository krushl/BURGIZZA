<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderBurger extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $primaryKey = null;
    public $incrementing = false;
    protected $fillable = [
        'burger_id',
        'order_id',
        'count',
        'special_requests',
        'add_ingredients',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function burger()
    {
        return $this->belongsTo(Burger::class);
    }
}
