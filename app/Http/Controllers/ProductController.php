<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Request $request)
{
    // Pega o estado da entrega do request, se houver
    $estadoDaEntrega = $request->input('estado_da_entrega');

    // Filtra os produtos com base no estado da entrega, se selecionado
    $produtos = Produto::when($estadoDaEntrega, function ($query) use ($estadoDaEntrega) {
        return $query->where('estado_da_entrega', $estadoDaEntrega);
    })->paginate(10); // Pega 10 produtos por página

    return view('product-visualization', compact('produtos', 'estadoDaEntrega'));
}


    public function store(Request $request){
        $request->validate([
            'codigo' => 'required|numeric',
            'rua' => 'required|string|max:255',
            'bairro' => 'required|string|max:255',
            'numero' => 'required|numeric',
            'cidade' => 'required|string|max:255',
            'estado' => 'required|string|max:255',
            'estado_da_entrega' => 'required|string|max:255',
        ]);

        Produto::create([
            'codigo' => $request->codigo,
            'rua' => $request->rua,
            'bairro' => $request->bairro,
            'numero' => $request->numero,
            'cidade' => $request->cidade,
            'estado' => $request->estado,
            'estado_da_entrega' => $request->estado_da_entrega,
        ]);

        return redirect()->route('product-registration')->with('success', 'Pacote registrado com sucesso!');
    }
}
