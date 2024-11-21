<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'produto';

    // Campos que podem ser preenchidos no banco de dados
    protected $fillable = [
        'code',         // Código do produto
        'description',  // Descrição do produto
        'addressId',    // ID do endereço relacionado
        'state',        // Estado do produto
    ];

    // Relacionamento com o modelo Endereco
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'addressId', 'id');
    }
}
