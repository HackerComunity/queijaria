<?php

use App\Support\Login;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('management.login');
});

Route::group(["prefix" => "management", "namespace" => "Management", "as" => "management."], function () {
   /*
    * Login Form...
    */
    Route::get('/', "AuthController@login")->name("login");
    Route::post("loginauth", "AuthController@loginAuth")->name("login.auth");

    /*
     * System Controller
     */
    Route::group(["middleware" => ["auth"]], function () {
        Route::get("home", "AuthController@home")->name("home");

        /**
         * Clientes e página inicial....
         */
        Route::resource('control', 'AppController');
        Route::get('clients-inactives', 'AppController@clientsInactives')->name('clients-inactives');
        Route::put('active-client/{client}', 'AppController@activeClient')->name('active-client');
        Route::delete('delete-client/{client}', 'AppController@deleteClient')->name('delete-client');
        Route::post('buscaClients', 'AppController@buscaClients')->name('buscaClients');
        Route::post('create-cliente', 'AppController@createCliente')->name('create.cliente');

        /**
         * Pagina de vendas...
         */
        Route::resource('sales', 'VendasController');
        Route::get('completed-sales', 'VendasController@completedSales')->name('sales-completed.sale');
        Route::get('show-sales-completed/{sale}', 'VendasController@shoeSaleCompleted')->name('show-sales-completed');
        Route::post('searchsale', 'VendasController@busca')->name('searchvenda.sale');

        /**
         * Pagina dos produtos..
         */
        Route::resource('products', 'ProdutoController');
        Route::get('products-inactives', 'ProdutoController@productsInactives')->name('products.products-inactives');
        Route::put('active-product/{product}', 'ProdutoController@activeProduct')->name('products.active-product');
        Route::delete('delete-product/{product}', 'ProdutoController@deleteProduct')->name('products.delete-product');

        /**
         * Getters
         */
        Route::post('/getters/{get}', 'AppController@getCliente')->name('get.clientes');

    });

    /**
     * Encerra a sessão...
     */
    Route::get('logout', 'AuthController@logout')->name("logout");
});
