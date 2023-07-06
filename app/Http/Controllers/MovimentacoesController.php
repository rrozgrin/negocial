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

            $data = DB::table('acionamentos')->max('data');
        } else {
            $data = $_POST['data'];
        }

        $dataArray = DB::select(
            "SELECT DISTINCT(`data`) AS 'data'
                                        FROM acionamentos
                                        WHERE MONTH(`data`) = (
                                                           SELECT MAX(MONTH(`data`)) FROM acionamentos 
                                        )
            ORDER BY 1 ASC"
        );

        $users = User::orderBy('name_user', 'ASC')->get();

        $mov = DB::table("acionamentos as a")
            ->join("negociadors as n", function ($join) {
                $join->on("n.id", "=", "a.user_id");
            })
            ->select("a.acionamento as ocorrencia", DB::raw('count(mci) as total'))
            ->where("a.data", "=", $data)
            ->groupBy('a.acionamento')
            ->orderBy('total', 'desc')
            ->get();

        $movi[] = ['ocorrencia', 'total'];
        $somaTotal = 0;

        foreach ($mov as $key => $value) {
            $movi[] = [$value->ocorrencia, (int)$value->total];
        }

        for ($i = 1; $i < sizeof($movi); $i++) {
            $somaTotal += $movi[$i][1];
        }


        return view('relatorios.movimentacoes.index', compact('users', 'mov', 'data', 'dataArray', 'somaTotal'))
            ->with('movi', json_encode($movi));
    }


    public function detalhado()
    {

        if (empty($_POST)) {
            $data = DB::table('acionamentos')->max('data');
            $negociador = 2023;
            $dataLigacoes = DB::table('ligacoes')->max('data');
            $ligacoes = DB::table("ligacoes AS l")
                ->select("l.negociador AS negociador", "l.qtd_atv AS ligacoes")
                ->where("l.data", "=", $dataLigacoes)
                ->orderBy('negociador', 'ASC')
                ->get();

            $acionamentos =
                DB::table("acionamentos AS a")
                ->join("negociadors AS n", function ($join) {
                    $join->on("n.id", "=", "a.user_id");
                })
                ->join("clientes AS c", function ($join) {
                    $join->on("a.mci", "=", "c.mci");
                })
                ->select(DB::raw('distinct(a.hora) as hora'), "c.nome AS cliente", "a.acionamento AS ocorrencia", "n.nome AS negociador")
                ->where("a.data", "=", $data)
                ->where("a.user_id", "like", '%')
                ->orderBy('negociador', 'ASC')
                ->orderBy('hora', 'ASC')
                ->get();
        } else {

            $data = $_POST['data'];

            if ($_POST['negociador'] == 2023) {
                $negociador = 2023;
                $acionamentos =
                    DB::table("acionamentos AS a")
                    ->join("negociadors AS n", function ($join) {
                        $join->on("n.id", "=", "a.user_id");
                    })
                    ->join("clientes AS c", function ($join) {
                        $join->on("a.mci", "=", "c.mci");
                    })
                    ->select(DB::raw('distinct(a.hora) as hora'), "c.nome AS cliente", "a.acionamento AS ocorrencia", "n.nome AS negociador")
                    ->where("a.data", "=", $data)
                    ->orderBy('negociador', 'ASC')
                    ->orderBy('hora', 'ASC')
                    ->get();
            } else {
                $negociador = $_POST['negociador'];

                $acionamentos =
                    DB::table("acionamentos AS a")
                    ->join("negociadors AS n", function ($join) {
                        $join->on("n.id", "=", "a.id");
                    })
                    ->join("clientes AS c", function ($join) {
                        $join->on("a.mci", "=", "c.mci");
                    })
                    ->select(DB::raw('distinct(a.hora) as hora'), "c.nome AS cliente", "a.acionamento AS ocorrencia", "n.nome AS negociador")
                    ->where("a.data", "=", $data)
                    ->where("a.user_id", "=", $negociador)
                    ->orderBy('negociador', 'ASC')
                    ->orderBy('hora', 'ASC')
                    ->get();
                dd($acionamentos);
            }

            
            $ligacoes = DB::table("ligacoes AS l")
                ->select("l.negociador AS negociador", "l.qtd_atv AS ligacoes")
                ->where("l.data", "=", $data)
                ->orderBy('negociador', 'ASC')
                ->get();
        }


        //dados gráfico ligações
        $liga[] = ['Negociadores', 'Total de ligações'];

        foreach ($ligacoes as $key => $value) {
            $liga[] = [$value->negociador, $value->ligacoes];
        }
        //--dados gráfico ligações

        //data para select|
        $dataArray = DB::select("SELECT DISTINCT(`data`)
        FROM acionamentos
        WHERE MONTH(`data`) = (SELECT MAX(MONTH(`data`)) FROM acionamentos )
        ORDER BY 1 ASC");

        //negociador para select|
        $negociadorArray = DB::select("SELECT * FROM negociadors ORDER BY 2 ASC");

        //dados gráfico acionamentos
        $pornegociador =
            DB::table("acionamentos as a")
            ->join("negociadors as n", function ($join) {
                $join->on("n.id", "=", "a.user_id");
            })
            ->join("clientes as c", function ($join) {
                $join->on("a.mci", "=", "c.mci");
            })
            ->select("n.nome as nome", DB::raw('count(distinct(c.mci)) as acionamentos'))
            ->where("a.data", "=", $data)
            ->groupBy('n.nome')
            ->get();


        $pornegociadorData[] = ['Negociador', 'Acionamentos'];
        foreach ($pornegociador as $key => $value) {
            $pornegociadorData[++$key] = [$value->nome, $value->acionamentos];
        }
        //--dados gráfico acionamentos

        return view('relatorios.movimentacoes.detalhado', compact('acionamentos', 'negociador', 'data', 'negociadorArray', 'dataArray'))
            ->with('pornegociadorData', json_encode($pornegociadorData))
            ->with('ligacoes', json_encode($liga));
    }
}
