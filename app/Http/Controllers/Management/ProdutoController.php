<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Http\Requests\Management\Produto as ProductRequest;
use App\Produtos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Produtos::where("situacao", 0)->get();
        echo view('Management.sections.Produtos.index')->with([
            "title" => "Queijo Caseiro | Produtos",
            "paginate" => $products,
            "nameuser" => Auth::user()
        ]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function productsInactives()
    {
        $products = Produtos::where("situacao", 1)->get();
        echo view('Management.sections.Produtos.products-inactive')->with([
            "title" => "Queijo Caseiro | Produtos",
            "paginate" => $products,
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
        echo view('Management.sections.Produtos.create-product')->with([
            "title" => "Queijo Caseiro | Novo produto",
            "nameuser" => Auth::user()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        /**
         * Insert new product....
         */
        $dados = [
            "cod_product" => $request->codigo_produto,
            "qnt_atual" => $request->quantidade,
            "descricao" => $request->desc,
            "tipo" => $request->tipo,
        ];

        /**
         * Checa se já existe o produto cadaastrado...
         */
        $produto = DB::table('produtos')->where('tipo', '=', $request->tipo)->get();
        if (!is_null($produto->first())) {
            return redirect()->back()->withInput()->withErrors(["Produto já cadastrado ou inativo!"]);
        } else {
            /**
             * Salva o produto se as condições acima estiverem incorretas...
             */
            $prod = Produtos::create($dados); // Save
            return redirect()->route('management.products.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = Produtos::where('id', $id)->first();
        echo view('Management.sections.Produtos.show-product')->with([
            "title" => "Queijo Caseiro | Produto",
            "paginate" => $products,
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
        $calc = intval($request->quantidade) + intval($request->adicionar);
        DB::table("produtos")->where('cod_product', "=", $request->codigo_produto)->update([
            "qnt_atual" => "$calc"
        ]);
        return redirect()->route("management.products.index");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (CheckTypeUser(Auth::user()->type) == "Administrador" || CheckTypeUser(Auth::user()->type) == "Desenvolvedor") {
            $client = Produtos::where('id', $id)->update(['situacao' => 1]);;
        }
        return redirect()->route("management.products.products-inactives");
    }

    public function activeProduct ($id)
    {
        if (CheckTypeUser(Auth::user()->type) == "Administrador" || CheckTypeUser(Auth::user()->type) == "Desenvolvedor") {
            $client = Produtos::where('id', $id)->update(['situacao' => 0]);
        }
        return redirect()->route("management.products.products-inactives");
    }

    public function deleteProduct($id)
    {
        if (CheckTypeUser(Auth::user()->type) == "Administrador" || CheckTypeUser(Auth::user()->type) == "Desenvolvedor") {
            $product = Produtos::destroy($id);
        }
        return redirect()->route("management.products.products-inactives");
    }
}
