<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClients extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('cod_client');
            $table->string('nome');
            $table->string('cidade');
            $table->string('endereco')->nullable();
            $table->string('estado')->nullable();
            $table->string('cep')->nullable();
            $table->string('valor_todos_pedidos')->nullable();
            $table->string('qnt_pendente')->nullable();
            $table->string('qnt_pago')->nullable();
            $table->string('qnt_total')->nullable();
            $table->string('valor_pendente')->nullable();
            $table->string('valor_ja_pago');
            $table->string('situacao')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
