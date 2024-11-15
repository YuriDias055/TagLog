<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('produto', function (Blueprint $table) {
            $table->id();
            $table->integer('codigo')->unique();
            $table->string('rua');
            $table->string('bairro');
            $table->integer('numero');
            $table->string('cidade');
            $table->string('estado');
            $table->enum('estado_da_entrega', ['pendente', 'na fila', 'em andamento', 'entregue'])->default('pendente');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('produto');
    }
};


