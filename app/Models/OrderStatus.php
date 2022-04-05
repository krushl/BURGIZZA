<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'status',
    ];

//    public function order()
//    {
//        return $this->belongsTo(Order::class,'status_id','id');
//    }
}
