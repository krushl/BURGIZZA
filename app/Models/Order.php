<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
      'user_id',
      'final_price',
      'address',
      'status_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function status()
    {
        return $this->hasOne(OrderStatus::class);
    }

    public function burger()
    {
        return $this->hasOne(OrderBurger::class, 'order_id','id');
    }

}
