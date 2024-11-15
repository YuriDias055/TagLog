<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'produto'; 

    protected $fillable = [
        'codigo',
        'rua',
        'bairro',
        'numero',
        'cidade',
        'estado',
        'estado_da_entrega',
    ];
}
