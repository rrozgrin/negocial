<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class DefasagemController extends Controller
{
    public function index(){
        $users = User::orderBy('name_user', 'ASC')->get();
        $acionados = DB::select(
            "SELECT n.nome negociador, COUNT(DISTINCT c.mci) acionado
            FROM clientes c
            INNER JOIN negociadors n
            ON c.negociador = n.id
            WHERE c.mci IN (SELECT a.mci FROM acionamentos a)
            GROUP BY 1
            ORDER BY 1 ASC"
        );
        $naoacionados = DB::select(
            "SELECT n.nome negociador, COUNT(DISTINCT c.mci) naoacionado
            FROM clientes c
            INNER JOIN negociadors n
            ON c.negociador = n.id
            WHERE c.mci NOT IN (SELECT a.mci FROM acionamentos a)
            GROUP BY 1
            ORDER BY 1 ASC"
        );
        $dados = array_map(null,$acionados,$naoacionados);
        return view('relatorios.defasagem.index',compact('users','acionados','naoacionados','dados'));
    }


}
