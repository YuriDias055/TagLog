<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalPacotes = DB::table('produtos')->count();

        $pacotesNaFila = DB::table('produtos')->where('state', 'f')->count();
        $pacotesEntregues = DB::table('produtos')->where('state', 'e')->count();
        

        $dadosGrafico = DB::table('produtos')
            ->select('state', DB::raw('count(*) as quantidade'))
            ->groupBy('state')
            ->pluck('quantidade', 'state')
            ->toArray();

        // Passar os dados para a view
        return view('dashboard', [
            'totalPacotes' => $totalPacotes,
            'pacotesNaFila' => $pacotesNaFila,
            'pacotesEntregues' => $pacotesEntregues,
            'dadosGrafico' => $dadosGrafico,
        ]);
    }
}
