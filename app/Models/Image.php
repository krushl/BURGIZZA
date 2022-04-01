<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    public $timestamps = false;
    protected $fillable = [
      'picture',
    ];

    public function burger()
    {
        return $this->hasMany(Burger::class);
    }

    public function article()
    {
        return $this->hasMany(Article::class);
    }


}
