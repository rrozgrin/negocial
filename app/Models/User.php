<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory;

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    protected $fillable = [
        'id',
        'name_user',
        'cpj_cobranca',
        'role_id',
        'password',
        'status',
        ];
}
