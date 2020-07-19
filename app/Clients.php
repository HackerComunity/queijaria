<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Clients extends Model
{
    protected $table = "clients";

    protected $fillable = [
        "valor_todos_pedidos",
        "qnt_pendente",
        "qnt_pago",
        "qnt_total",
        "valor_pendente",
        "valor_ja_pago",
        "cod_client",
        "nome",
        "cidade",
        "endereco",
        "estado",
        "cep",
    ];
}
