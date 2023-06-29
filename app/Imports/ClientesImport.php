<?php

namespace App\Imports;

use App\Models\Cliente;
use Maatwebsite\Excel\Concerns\ToModel;

class ClientesImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Cliente([
            'mci' => $row[0],
            'nome' => $row[1],
            'cpf_cnpj' => $row[2],
            'negociador' => $row[3],
            'comarca' => $row[4],
            'uf' => $row[5],
            'empresa_id' => $row[6]
        ]);
    }
}
