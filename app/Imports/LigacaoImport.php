<?php

namespace App\Imports;

use App\Models\Ligacao;
use Maatwebsite\Excel\Concerns\ToModel;

class LigacaoImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Ligacao([
            'data' => $row[0],
            'negociador' => $row[1],
            'tempo_logado' => $row[2],
            'tempo_pausa' => $row[3],
            'pausa' => $row[4],
            'tempo_disp' => $row[5],
            'disp' => $row[6],
            'tempo_atc_recep' => $row[7],
            'em_chamadas' => $row[8],
            'qtd_atv' => $row[9],
            'qtd_completa' => $row[10],
            'tempo_inter' => $row[11],
            'qtd_nao_completa' => $row[12],
        ]);
    }
}
