<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Produtos extends Model
{
    protected $table = "produtos";
    protected $fillable = [
        "cod_product",
        "qnt_atual",
        "descricao",
        "tipo",
    ];
}
