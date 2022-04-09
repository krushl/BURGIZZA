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
       'phone',
      'status_id',
        'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function status()
    {
        return $this->hasOne(OrderStatus::class);
    }

    public function burgers()
    {
        return $this->hasMany(OrderBurger::class, 'order_id','id');
    }

}
