<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ligacao extends Model
{
    use HasFactory;

    protected $table = 'ligacoes';

    protected $fillable = [
        'data',
        'negociador',
        'tempo_logado',
        'tempo_pausa',
        'pausa',
        'tempo_disp',
        'disp',
        'tempo_atv_recep',
        'em_chamadas',
        'qtd_atv',
        'qtd_completa',
        'tempo_inter',
        'qtd_nao_completa',
    ];
}
