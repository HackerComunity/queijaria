<?php

function CheckPending($value) {
    if ($value == 0) return "Pendente";
    if ($value == 1) return "Pago";
}

function CheckTypeUser($value) {
    if ($value == 0) return "Administrador";
    if ($value == 1) return "Vendedor";
}

function generator()
{
    $word = array();
    $setAlpha = "0123456789";
    $length = strlen($setAlpha);
    for ($p = 0; $p < 5; $p++)
    {
        $n = rand(0, $length);
        $word[] = $setAlpha[$n];
    }
    return implode($word);
}

function randString($len){
    $chars = '0123456789';

    $return= "";

    for($i= 0; $len > $i; $i++){
        $return.= $chars[rand(0, strlen($chars) - 1)];
    }

    return $return;
}

function GeraCodigClient() {
    $aux = "";
    while (true) {

        $cod = randString(5);
        $clients = \Illuminate\Support\Facades\DB::table('clients')->where('cod_client', $cod)->get();

        foreach ($clients as $client) {
            $aux = $client->cod_client;
        }
        if ($aux == $cod) {
            continue;
        } else {
            break;
        }
    }
    return $cod;
}

function GeraCodigVenda() {
    $aux = "";
    while (true) {

        $cod = randString(7);
        $vendas = \Illuminate\Support\Facades\DB::table('venda')->where('cod_venda', $cod)->get();

        foreach ($vendas as $venda) {
            $aux = $venda->cod_venda;
        }
        if ($aux == $cod) {
            continue;
        } else {
            break;
        }
    }
    return $cod;
}

function GeraCodigProduct() {
    $aux = "";
    while (true) {

        $cod = randString(7);
        $vendas = \Illuminate\Support\Facades\DB::table('produtos')->where('cod_product', $cod)->get();

        foreach ($vendas as $venda) {
            $aux = $venda->cod_venda;
        }
        if ($aux == $cod) {
            continue;
        } else {
            break;
        }
    }
    return $cod;
}

function Mensagem($mensagem, $type_class)
{
    echo "<div class='alert $type_class' role='alert'>$mensagem</div>";
}
