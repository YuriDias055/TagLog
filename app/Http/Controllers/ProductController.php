<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Endereco;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Função para exibir o formulário de cadastro de produto
    public function create()
    {
        // Recuperar todos os endereços
        $enderecos = Endereco::all();

        // Retornar a view com os endereços
        return view('product-registration', compact('enderecos'));
    }

    // Função para armazenar o produto
    public function store(Request $request)
    {
        // Validação
        $validated = $request->validate([
            'code' => 'required|string|max:255',
            'description' => 'nullable|string',
            'addressId' => 'required|exists:enderecos,id', // Validação para garantir que o endereço existe
            'state' => 'required|string|max:1', // Estado é obrigatório e deve ter um caractere
        ]);

        // Inserção no banco
        Produto::create([
            'code' => $validated['code'],
            'description' => $validated['description'],
            'addressId' => $validated['addressId'],
            'state' => $validated['state'], // Estado é "P" por padrão
        ]);

        // Redirecionamento com mensagem de sucesso
        return redirect()->route('product-registration')->with('success', 'Produto cadastrado com sucesso!');
    }

    // Função para exibir a visualização de produtos com filtro
    public function visualizar(Request $request)
    {
        // Mapear os estados da entrega para os códigos e nomes
        $estadoMap = [
            'P' => 'Pendente',
            'F' => 'Na fila',
            'A' => 'Em andamento',
            'E' => 'Entregue',
        ];
        
        // Obter o filtro do estado da entrega a partir da requisição
        $estadoFiltro = $request->query('estado_da_entrega');
        
        // Query base para produtos, com o relacionamento de endereço
        $query = Produto::with('endereco'); // Carrega o endereço associado ao produto
        
        // Filtrar pelo estado da entrega, se o filtro foi fornecido e é válido
        if (!empty($estadoFiltro) && in_array($estadoFiltro, array_keys($estadoMap))) {
            $query->where('state', $estadoFiltro);
        }
        
        // Obter os produtos com paginação
        $produtos = $query->paginate(10);
        
        // Substituir as abreviações pelos nomes completos
        foreach ($produtos as $produto) {
            $produto->state = $estadoMap[$produto->state] ?? $produto->state;
        }
        
        // Retornar a view com os produtos, estados e endereços
        return view('product-visualization', [
            'produtos' => $produtos,
            'estadoDaEntrega' => $estadoFiltro,
            'estadoMap' => $estadoMap, // Para usar no dropdown
        ]);
    }

    // Função para retornar um produto específico junto com seu endereço em formato JSON
    public function getProduto($id)
    {
        // Carregar o produto junto com o endereço
        $produto = Produto::with('endereco')->findOrFail($id);

        // Retornar os dados como JSON
        return response()->json($produto);
    }
}
