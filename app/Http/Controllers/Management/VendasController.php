<?php

namespace App\Http\Controllers\Management;

use App\Clients;
use App\Http\Controllers\Controller;
use App\Vendas;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class VendasController extends Controller
{
    public function busca(Request $request)
    {
        //
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendas = DB::table('venda')->where('tipo', 0)->get();
        echo view('Management.sections.Venda.vendas')->with([
            "title" => "Queijo Caseiro | Vendas",
            "paginate" => $vendas,
            "nameuser" => Auth::user()
        ]);
    }

    /**
     * Busca as vendas inativas, que já estão concluidas...
     */
    public function completedSales()
    {
        $vendas = DB::table('venda')->where('tipo', 1)->get();
        echo view('Management.sections.Venda.vendas-finalizadas')->with([
            "title" => "Queijo Caseiro | Vendas Finalizadas",
            "paginate" => $vendas,
            "nameuser" => Auth::user()
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function shoeSaleCompleted($id)
    {
        $vendas = Vendas::where('id', $id)->first();
        echo view('Management.sections.Venda.show-venda-completed')->with([
            "title" => "Queijo Caseiro | Vendas",
            "paginate" => $vendas,
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $vendas = Vendas::where('id', $id)->first();
        echo view('Management.sections.Venda.show-venda')->with([
            "title" => "Queijo Caseiro | Vendas",
            "paginate" => $vendas,
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
        $req = $request->all();
        echo "<pre>";
        print_r($req);
        echo "</pre>";
        echo $req["quantidade"];

        $client = Clients::where('id', $req["cod_client"])->first();

        // Valores recuperados de clientes para serem atualizados com a baixa...
        $valor_ja_pago = floatval(str_replace("R$", "", $client->valor_ja_pago)) + floatval(str_replace("R$", "", $req["valor_venda"]));
        $valor_pendente = floatval(str_replace("R$", "", $client->valor_pendente)) - floatval(str_replace("R$", "", $req["valor_venda"]));
        $qnt_pendente = intval($client->qnt_pendente) - intval($req["quantidade"]);
        $qnt_pago = intval($client->qnt_pago) + intval($req["quantidade"]);

        $dados_clients = [
            "qnt_pendente" => $qnt_pendente,
            "qnt_pago" => $qnt_pago,
            "valor_pendente" => "R$ $valor_pendente",
            "valor_ja_pago" => "R$ $valor_ja_pago"
        ];
        // Updated table clients...
        $client = DB::table('clients')->where('id', '=', $req["cod_client"])->update($dados_clients);

        // Updated table vend....
        $venda = DB::table('venda')->where('id', $id)->update([
            'tipo' => 1
        ]);

        return redirect()->route('management.sales.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
