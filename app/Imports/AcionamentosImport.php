<?php

namespace App\Imports;

use App\Models\Acionamento;
use Maatwebsite\Excel\Concerns\ToModel;

class AcionamentosImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Acionamento([
            'mci' => $row[0],
            'pesquisa' => $row[1],
            'acionamento' => $row[2],
            'data' => $row[3],
            'hora' => $row[4],
            'user_id' => $row[5],
        ]);
    }
}
