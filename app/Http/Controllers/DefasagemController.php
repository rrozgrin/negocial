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


        $query = DB::select(
            "SELECT n.id , 
                        (SELECT COUNT(c.mci)
                            FROM clientes c
                            WHERE c.mci NOT IN (SELECT a.mci FROM acionamentos a) AND c.empresa_id = '" . $carteira . "' AND (c.negociador = n.id)) AS 'naoAcionados',
                        (SELECT COUNT(c.mci)
                            FROM clientes c
                            WHERE c.mci IN (SELECT a.mci FROM acionamentos a) AND c.empresa_id = '" . $carteira . "' AND (c.negociador = n.id)) AS 'acionados'
                        FROM negociadors n
                        GROUP BY n.id
                        ORDER BY n.id ASC"
        );          
        return view('relatorios.defasagem.index', compact('users', 'carteiras', 'query' ))->with('query_json', json_encode($query));
    }
}
