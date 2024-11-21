<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Criação da tabela 'enderecos'
        Schema::create('enderecos', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->string('street', 50); // Nome da rua
            $table->smallInteger('num'); // Número (smallint)
            $table->string('district', 50); // Bairro
            $table->string('city', 50); // Cidade
            $table->string('state', 16); // Estado
            $table->string('info', 255)->nullable(); // Informação adicional (opcional)
            $table->timestamps(); // Campos 'created_at' e 'updated_at'
        });
    }

    public function down()
    {
        // Exclusão da tabela 'enderecos'
        Schema::dropIfExists('enderecos');
    }
};
