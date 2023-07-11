<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ImportadoresController extends Controller
{
    public function index()
    {
        return view('admin.import.index');
    }
}
