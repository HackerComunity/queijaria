<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVenda extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venda', function (Blueprint $table) {
            $table->id();
            $table->integer('cod_client');
            $table->integer('cod_venda')->unique();
            $table->string('nome_client');
            $table->text('observacoes')->nullables();
            $table->string('vendedor');
            $table->string('valor_venda');
            $table->string('data_venda');
            $table->string('quantidade');
            $table->string('lote')->nullable();
            $table->boolean('tipo')->default(0);
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
        Schema::dropIfExists('venda');
    }
}
