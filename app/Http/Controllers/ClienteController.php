<?php

namespace App\Http\Controllers;

use App\Imports\ClientesImport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class ClienteController extends Controller
{
    public function index()
    {
        return view('admin.import.clientes-import');
    }

    public function import()
    {
        // dd(request()->file('clientes_xlsx.xlsx'));
        Excel::import(new ClientesImport, request()->file('file'),\Maatwebsite\Excel\Excel::XLSX);
        return view('admin.users');
    }
}
