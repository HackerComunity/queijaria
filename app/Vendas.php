<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Vendas extends Model
{
    protected $table = "venda";

    protected $fillable = [
        "cod_client",
        "cod_venda",
        "nome_client",
        "observacoes",
        "vendedor",
        "qnt_pendente",
        "valor_pendente",
        "data_venda",
        "lote"
    ];
}
