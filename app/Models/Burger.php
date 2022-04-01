<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Burger extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
        'name',
        'price',
        'image_id',
        'category_id',
        'composition',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }

    public function order()
    {
        return $this->hasMany(OrderBurger::class,'burger_id','id');
    }

}
