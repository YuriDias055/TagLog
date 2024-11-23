<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Produto extends Model
{
    use HasFactory;

    // Nome da tabela no banco de dados
    protected $table = 'produtos';

    // Campos que podem ser preenchidos no banco de dados
    protected $fillable = [
        'code',          // Código do produto
        'description',   // Descrição do produto
        'addressId',     // ID do endereço relacionado
        'state',         // Estado do produto
        'empresaId',     // ID do usuário (empresa)
        'dataCadastro',  // Data de cadastro
    ];

    // Relacionamento com o modelo Endereco
    public function endereco()
    {
        return $this->belongsTo(Endereco::class, 'addressId', 'id');
    }

    // Geração automática de valores padrão
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid(); // Gera um UUID único
            }
        });

        static::creating(function ($model) {
            if (empty($model->dataCadastro)) {
                $model->dataCadastro = now(); // Define a data atual
            }
        });
    }

    public $timestamps = false;
}
