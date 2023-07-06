<?php

namespace App\Http\Controllers;

use App\Imports\AcionamentosImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class AcionamentoController extends Controller
{
    public function index()
    {
        return view('admin.import.acionamentos-import');
    }

    public function import()
    {
        Excel::import(new AcionamentosImport(), request()->file('file'));
        return redirect(route('rel.mov'));
    }
}
