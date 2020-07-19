<?php

namespace App\Http\Controllers\Management;

use App\Clients;
use App\Http\Controllers\Controller;
use App\Produtos;
use App\User;
use App\Vendas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use function GuzzleHttp\Promise\all;

class AppController extends Controller
{
    /* ======================== SESSÂO DE DADOS ========================== */

    /**
     * @return int
     */
    public function getCliente($get)
    {
        if ($get == "getters-clients") {
            return $clients = DB::table('clients')->count("*");
        } elseif ($get == "getters-sales") {
            return $sales = DB::table('venda')->count("*");
        } elseif ($get == "getters-sales-completed") {
            return $sales = DB::table("venda")->where('tipo', 1)->count("*");
        } elseif ($get == "getters-sales-pending") {
            return $sales = DB::table("venda")->where('tipo', 0)->count("*");
        } elseif ($get == "getters-value-total") {
            $clients = DB::table("clients")->get('valor_todos_pedidos');
            $calc_values = 0;
            foreach ($clients as $values) {
                $calc_values += floatval(str_replace("R$", "", $values->valor_todos_pedidos));
            }
            return floatval($calc_values);
        } elseif ($get == "getters-value-pending") {
            $clients = DB::table("clients")->get('valor_pendente');
            $calc_values = 0;
            foreach ($clients as $values) {
                $calc_values += floatval(str_replace("R$", "", $values->valor_pendente));
            }
            return floatval($calc_values);
        } elseif ($get == "getters-value-pago") {
            $clients = DB::table("clients")->get('valor_ja_pago');
            $calc_values = 0;
            foreach ($clients as $values) {
                $calc_values += floatval(str_replace("R$", "", $values->valor_ja_pago));
            }
            return floatval($calc_values);
        }
    }

    /* ======================== SESSÂO DE APLICAÇÂO FRONT ========================== */
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = DB::table('clients')->where('situacao', 0)->get();
        echo view('Management.sections.index')->with([
            "title" => "Queijo Caseiro | Clientes",
            'paginate' => $clientes,
            "nameuser" => Auth::user()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function clientsInactives()
    {
        $clientes = DB::table('clients')->where('situacao', 1)->get();
        echo view('Management.sections.clients-inactive')->with([
            "title" => "Queijo Caseiro | Clientes inativos",
            'paginate' => $clientes,
            "nameuser" => Auth::user()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        echo view('Management.sections.create-client')->with([
            "title" => "Queijo Caseiro | Novo cliente",
            "nameuser" => Auth::user()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function buscaClients(Request $request)
    {
        $clientes = DB::table('clients')->paginate(5);
        return $clientes;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function createCliente(Request $request)
    {
        $dados = [
            "cod_client" => $request->cod_client,
            "nome" => $request->name_client,
            "cidade" => $request->cidade,
            "endereco" => $request->endereco,
            "estado" => $request->estado,
            "cep" => $request->cep,
            "valor_todos_pedidos" => 'R$ 0',
            "qnt_pendente" => '0',
            "qnt_pago" => '0',
            "valor_pendente" => 'R$ 0',
            "valor_ja_pago" => 'R$ 0',
        ];
        $clients = Clients::create($dados);
        return redirect()->route('management.control.index');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Seleciona coluna valor_todos_pedidos...
         * Calcula soma o valor da venda com o valor total da venda recuperado do bando de dados...
        */
        $valor_total = "";
        $aux_client = DB::table('clients')->where('cod_client', "=", $request->codigo_client)->first();

        if (str_replace("R$", "", $aux_client->valor_todos_pedidos) === "0") {
            $valor_total = $request->valor_total_todos_pedidos;
        } else {
            $value = floatval(str_replace("R$", "", $aux_client->valor_todos_pedidos));
            $value_venda = floatval(str_replace("R$", "", $request->valor_da_venda));
            $valor_total = floatval($value_venda + $value);
        }

        /**
         * Realizando a baixa na tabela produto de quantos produtos foram comprados...
         */
        $aux_produto = DB::table('produtos')->where("tipo", "=",  $request->tipo_produto)->first();

        if (is_null($aux_produto)) {
            return redirect()->back()->withInput()->withErrors(["Oooops! Por favor, selecione um produto existente!"]);
        } else {
            if (intval($aux_produto->qnt_atual) <= 0) {
                return redirect()->back()->withErrors(["Oooops! Não foi possível realizar a venda, pois não existe prdutos em estoque!"])->withInput();
            } else {
                if (intval($request->qnt_compra) > intval($aux_produto->qnt_atual)) {
                    return redirect()->back()->withErrors(["Oooops! Não foi possível realizar a venda, pois a quantidade vendida é maior que a quantidade em estoque!"])->withInput();
                } else {
                    $quantidade_atual = intval($aux_produto->qnt_atual);
                    $quantidade_compra = intval($request->qnt_compra);
                    $qnt_baixa_produto = $quantidade_atual - $quantidade_compra;

                    $produto = DB::table('produtos')->where('tipo', '=', $request->tipo_produto)->update(["qnt_atual" => $qnt_baixa_produto]);
                }
            }
        }

        /**
         * insert table venda....
         */
        $dados_venda = [
            "cod_client" => $request->cod_client,
            "cod_venda" => $request->codigo_venda,
            "nome_client" => $request->name_client,
            "observacoes" => $request->observacoes,
            "vendedor" => $request->vendedor,
            "valor_venda" => $request->valor_da_venda,
            "quantidade" => $request->qnt_compra,
            "data_venda" =>$request->data_venda,
            "lote" => $request->lote,
        ];
        $venda = DB::table('venda')->insert($dados_venda);

        /**
         * update table client....
         */
        $dados_client = [
            "valor_todos_pedidos" => "R$ $valor_total",
            "qnt_pendente" => $request->qnt_pendente,
            "qnt_pago" => $request->total_pagos,
            "qnt_total" => $request->total_todos_pedidos,
            "valor_pendente" => $request->valor_total_pendente,
            "valor_ja_pago" => $request->valor_total_pagos,
        ];

        $clients = DB::table('clients')->where('id', $request->cod_client)->update($dados_client);

        return redirect()->route('management.control.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Produtos::where("situacao", 0)->get();
        $clientes = Clients::where('id', $id)->first();
        echo view('Management.sections.realizar-venda')->with([
            "title" => "Queijo Caseiro | Nova venda",
            "client" => $clientes,
            "products" => $products,
            "nameuser" => Auth::user()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Desativando cliente.
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (CheckTypeUser(Auth::user()->type) == "Administrador" || CheckTypeUser(Auth::user()->type) == "Desenvolvedor") {
            $client = Clients::where('id', $id)->update(['situacao' => 1]);
        }
        return redirect()->route("management.control.index");
    }

    /**
     * Ativando cliente
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function activeClient ($id)
    {
        if (CheckTypeUser(Auth::user()->type) == "Administrador" || CheckTypeUser(Auth::user()->type) == "Desenvolvedor") {
            $client = Clients::where('id', $id)->update(['situacao' => 0]);
        }
        return redirect()->route("management.clients-inactives");
    }

    /**
     * Deletando cliente permanentemente
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function deleteClient($id)
    {
        if (CheckTypeUser(Auth::user()->type) == "Administrador" || CheckTypeUser(Auth::user()->type) == "Desenvolvedor") {
            $client = Clients::destroy($id);
        }
        return redirect()->route("management.clients-inactives");
    }
}
