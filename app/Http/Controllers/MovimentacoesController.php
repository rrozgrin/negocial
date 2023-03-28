<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class MovimentacoesController extends Controller
{
    public function index()
    {


        if (empty($_POST)) {
            $users = User::orderBy('name_user', 'ASC')->get();
            $mov = DB::select("SELECT a.acionamento 'ocorrencia' ,COUNT(a.mci) 'total'
            FROM acionamentos a
            INNER JOIN negociadorS n
            ON n.id = a.user_id
            WHERE a.`data` = (SELECT MAX(`data`) FROM acionamentos) 
            GROUP BY 1
            ORDER BY 2 DESC;");

            $data = DB::select("SELECT DISTINCT(`data`)
            FROM acionamentos
            WHERE MONTH(`data`) = (SELECT MAX(MONTH(`data`)) FROM acionamentos )
            
        ");
            $dataatual = DB::table('acionamentos')->max('data');

            return view('relatorios.movimentacoes.index', compact('users', 'mov', 'data', 'dataatual'));
        }
    }

    public function indexdata()
    {

        $dia = $_POST['data'];

        $users = User::orderBy('name_user', 'ASC')->get();
        $mov = DB::select("SELECT a.acionamento 'ocorrencia' ,COUNT(a.mci) 'total'
                FROM acionamentos a
                INNER JOIN negociadorS n
                ON n.id = a.user_id
                WHERE a.`data` = '$dia'
                GROUP BY 1
                ORDER BY 2 DESC;");

        $data = DB::select("SELECT DISTINCT(`data`)
            FROM acionamentos
            WHERE MONTH(`data`) = (SELECT MAX(MONTH(`data`)) FROM acionamentos )
    ");


        return view('relatorios.movimentacoes.index', compact('users', 'mov', 'data', 'dia'));
    }

    public function individual()
    {

        $negociador = DB::select("SELECT * FROM negociadors ORDER BY 2 ASC");
        $dataatual = DB::table("acionamentos")->max('data');
        $data = DB::select("SELECT DISTINCT(`data`)
        FROM acionamentos
        WHERE MONTH(`data`) = (SELECT MAX(MONTH(`data`)) FROM acionamentos )");

        $acionamentos=
        DB::table("acionamentos AS a")
        ->join("negociadors AS n", function($join){
            $join->on("n.id", "=", "a.user_id");
        })
        ->join("clientes AS c", function($join){
            $join->on("a.mci", "=", "c.mci");
        })
        ->select( DB::raw('distinct(a.hora) as hora'), "c.nome AS cliente", "a.acionamento AS ocorrencia", "n.nome AS negociador")
        ->where("a.data", "=", $dataatual)
        ->where("a.user_id", "like", '%')
        ->orderBy('negociador','ASC')
        ->orderBy('hora','ASC')
        ->get();


        $pornegociador = 
        DB::table("acionamentos as a")
        ->join("negociadors as n", function($join){
            $join->on("n.id", "=", "a.user_id");
        })
        ->join("clientes as c", function($join){
            $join->on("a.mci", "=", "c.mci");
        })
        ->select("n.nome as nome", DB::raw('count(distinct(c.mci)) as acionamentos') )
        ->where("a.data", "=", '2022-11-17')
        ->groupBy('n.nome')
        ->get();

        
        foreach ($pornegociador as $key => $value[]) {
            dd(json_encode($value[$key].['nome']));
            $pornegociadorData[] = [$value, $value[$key]['acionamentos']];
        }


        return view('relatorios.movimentacoes.individual', compact('acionamentos', 'data', 'negociador', 'dataatual'));
    }

    public function individualselecionado()
    {

        $negselecionado = (int)$_POST['negociador'];
        $dia = $_POST['data'];
        // dd($negselecionado);

        $acionamentos = DB::select("SELECT   DISTINCT a.hora 'hora', c.nome 'cliente', a.acionamento 'ocorrencia', n.nome 'negociador'
        FROM acionamentos a
        INNER JOIN negociadors n
        ON n.id = a.user_id
        INNER JOIN clientes c
        ON a.mci = c.mci
        WHERE a.`data` = '$dia' AND	a.user_id LIKE '%$negselecionado'

        ORDER BY 4, 1 ASC;");

        $negociador = DB::select("SELECT * FROM negociadors ORDER BY 2 ASC");


        $data = DB::select("SELECT DISTINCT(`data`)
        FROM acionamentos
        WHERE MONTH(`data`) = (SELECT MAX(MONTH(`data`)) FROM acionamentos )");

        return view('relatorios.movimentacoes.individual', compact('acionamentos', 'data', 'negociador', 'dia', 'negselecionado'));
    }
}
