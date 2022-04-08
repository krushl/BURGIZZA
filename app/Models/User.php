<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    public $timestamps = false;
    /**
     * @inheritdoc
     * @var string[]
     */
    protected $fillable = [
        'login',
        'password',
        'email',
        'name',
        'role_id',
    ];

    /**
     *  Связь с таблицей roles
     */
    public function roles()
    {
        return $this->hasMany(Role::class,'id','role_id');
    }

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }

    /**
     * Связь с таблицей orders
     * @return HasMany
     */
    public function orders() : HasMany
    {
        return $this->hasMany(Order::class);
    }
}
