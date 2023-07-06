<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LigacoesController extends Controller
{
    public function index()
    {
        if (empty($_POST)) {
            $dia = DB::table('ligacoes')->max('data');
        } else {
            $dia = $_POST['data'];
        }

        $ligacoes = DB::table("ligacoes AS l")
            ->select("*")
            ->where("l.data", "=", $dia)
            ->orderBy('negociador', 'ASC')
            ->get();


        $data = DB::select("SELECT DISTINCT(`data`)
                                        FROM ligacoes
                                        WHERE MONTH(`data`) = (SELECT MAX(MONTH(`data`)) FROM ligacoes )
                                    ");

        return view('relatorios.ligacoes.index', compact('ligacoes', 'data', 'dia'));
    }
}
