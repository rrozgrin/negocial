<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DefasagemController extends Controller
{
    public function index()
    {
        $users = User::orderBy('name_user', 'ASC')->get();



        $acionados = DB::select(
            "SELECT n.nome as negociador_, COUNT(DISTINCT c.mci) as acionado
            FROM clientes c
            INNER JOIN negociadors n
            ON c.negociador = n.id
            WHERE c.mci IN (SELECT a.mci FROM acionamentos a)
            GROUP BY 1
            ORDER BY 1 ASC"
        );
        $naoacionados = DB::select(
            "SELECT n.nome as negociador, COUNT(DISTINCT c.mci) as naoacionado
            FROM clientes c
            INNER JOIN negociadors n
            ON c.negociador = n.id
            WHERE c.mci NOT IN (SELECT a.mci FROM acionamentos a)
            GROUP BY 1
            ORDER BY 1 ASC"
        );
        $acionadosData[] = ['Negociador', 'Acionado', 'Naoacionado'];

        foreach ($acionados as $key => $value) {
            foreach ($naoacionados as $key => $value_n) {
                if($value->negociador_ == $value_n->negociador){
                    $acionadosData[++$key] = ['negociador'=>$value->negociador_, 'acionados'=>$value->acionado, 'defasagem'=>$value_n->naoacionado];
                }
            }
        }

        $acionadosGraf[] = ['Negociador', 'defasagem'];

        foreach ($acionados as $key => $value) {
            foreach ($naoacionados as $key => $value_n) {
                if($value->negociador_ == $value_n->negociador){
                    $acionadosGraf[++$key] = [$value->negociador_,$value->acionado / (($value->acionado + $value_n->naoacionado))*100];
                }
            }
        }

            return view('relatorios.defasagem.index', compact('users', 'acionados', 'naoacionados', 'acionadosData'))->with('acionadosGraf',json_encode($acionadosGraf));
    }
}
