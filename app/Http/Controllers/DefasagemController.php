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

        $carteiras = DB::table('clientes')
            ->join("empresas as e", function ($join) {
                $join->on("e.id", "=", "empresa_id");
            })
            ->select('empresa_id', 'e.nome_empresa')
            ->distinct()
            ->get();

        if (empty($_POST)) {
            $carteira = $carteiras[0]->empresa_id;
        } else {
            $carteira = $_POST['carteira'];
        }

        //consulta defasagem [ acioanados / (acionados + não acionados) ]
        $query = DB::select(
            "SELECT n.id , 
                        (SELECT ne.nome FROM negociadors AS ne WHERE n.id = ne.id) AS nome,
                        (SELECT COUNT(c.mci)
                            FROM clientes c
                            WHERE c.mci NOT IN (SELECT a.mci FROM acionamentos a) AND c.empresa_id = '" . $carteira . "' AND (c.negociador = n.id)) AS 'naoAcionados',
                        (SELECT COUNT(c.mci)
                            FROM clientes c
                            WHERE c.mci IN (SELECT a.mci FROM acionamentos a) AND c.empresa_id = '" . $carteira . "' AND (c.negociador = n.id)) AS 'acionados'
                        FROM negociadors n
                        GROUP BY 1
                        ORDER BY 1 ASC"
        );

        //dados para alimentar o gráfico
        $acionadosGraf[] = ['Negociador', 'Defasagem'];
        foreach ($query as $key => $value) {
            $acionadosGraf[] = [$value->nome, $value->acionados / (($value->acionados + $value->naoAcionados)) * 100];
        }

        return view('relatorios.defasagem.index', compact('users', 'carteiras', 'query'))->with('query_json', json_encode($acionadosGraf));
    }
}
