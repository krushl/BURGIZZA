<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    public const ADMIN_ROLE = 'admin';
    public $timestamps = false;
    /**
     * @inheritdoc
     * @var string[]
     */
    protected $fillable = [
        'role',
    ];

    public function user()
    {
        return $this->belongsTo(User::class,'role_id','id');
    }
}
