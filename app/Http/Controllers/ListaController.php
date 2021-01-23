<?php

namespace App\Http\Controllers;
use DB;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Szervizkonyv;

class ListaController extends Controller
{
    public function index()
    {
        return view('lista');
    }
}
