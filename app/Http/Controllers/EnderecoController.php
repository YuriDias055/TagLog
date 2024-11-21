<?php
namespace App\Http\Controllers;

use App\Models\Endereco;
use Illuminate\Http\Request;

class EnderecoController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'street' => 'required|string|max:50',
            'district' => 'required|string|max:50',
            'num' => 'required|integer',
            'city' => 'required|string|max:50',
            'state' => 'required|string|max:16',
        ]);

        Endereco::create([
            'street' => $request->street,
            'district' => $request->district,
            'num' => $request->num,
            'city' => $request->city,
            'state' => $request->state,
        ]);

        return redirect()->back()->with('success', 'Endereço cadastrado com sucesso!');
    }
}
