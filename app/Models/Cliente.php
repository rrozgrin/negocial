<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $fillable=[
        'mci',
        'nome',
        'cpf_cnpj',
        'negociador',
        'comarca',
        'uf',
        'empresa_id',
    ];

}
