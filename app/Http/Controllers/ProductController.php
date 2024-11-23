<?php

namespace App\Http\Controllers;

use App\Models\Produto;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

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

    public function store(Request $request){
        // Validação dos dados da requisição
        $request->validate([
            'code' => 'required|string|max:15',
            'description' => 'required|string|max:255',
            'addressId' => 'required|integer|exists:enderecos,id',
        ]);
    
        // Verificar se addressId já existe 
        if (Produto::where('addressId', $request->input('addressId'))->exists()){ 
            return redirect()->back()->withErrors(['addressId' => 'Este endereço já está associado a um pacote.']);
        }

        // Criação de uma nova instância do Produto e preenchimento com os dados da requisição
        $produto = new Produto();
        $produto->code = $request->input('code');
        $produto->description = $request->input('description');
        $produto->addressId = $request->input('addressId');
        $produto->state = 'P'; // Estado padrão
            
        // Gera um UUID único para o ID do produto
        $produto->id = (string) Str::uuid();
        $produto->dataCadastro = now();
    
        // Salvamento da nova instância do Produto no banco de dados
        $produto->save();
    
        // Redirecionamento ou retorno de uma resposta
        return redirect()->back()->with('success', 'Endereço cadastrado com sucesso!');
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
