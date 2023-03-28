<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
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
