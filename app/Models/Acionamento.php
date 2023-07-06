<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acionamento extends Model
{
    use HasFactory;

    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'mci');
    }

    public function negociador()
    {
        return $this->belongsTo(Negociadors::class, 'id');
    }

    protected $fillable = [
        'mci',
        'pesquisa',
        'acionamento',
        'data',
        'hora',
        'user_id',
    ];
}
