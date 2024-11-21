<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        // Remove a tabela existente 'produto', se existir
        if (Schema::hasTable('produto')) {
            Schema::drop('produto');
        }

        // Cria a nova tabela 'produto' com a estrutura solicitada
        Schema::create('produto', function (Blueprint $table) {
            $table->id(); // Chave primária
            $table->string('code', 15)->unique(); // Código único
            $table->dateTime('dataCadastro', 6)->default(now()); // Data de cadastro com precisão
            $table->char('state', 1); // Estado (char único)
            $table->string('description', 255)->nullable(); // Descrição opcional
            $table->integer('addressId')->nullable(); // ID do endereço opcional
            $table->string('empresaId', 36)->nullable(); // ID da empresa opcional (UUID)
            $table->timestamps(); // Campos 'created_at' e 'updated_at'
        });
    }

    public function down()
    {
        // Remove a tabela 'produto'
        Schema::dropIfExists('produto');
    }
};
