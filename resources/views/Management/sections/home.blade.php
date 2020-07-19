@extends("Management.master")

@section("csrf-tokens")
    <meta name="csrf-token-1" content="{{ csrf_token() }}">
@endsection

@section('content')

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-2">
                <h3>Resumo</h3>
            </div>

        </div>
    </div>

    <div class="container">
        <div class="row text-center">
            <div class="col-12 col-md-3">
                <div class="card bg-light mb-3" style="max-width: 18rem; border: #b3843a 1px solid; box-shadow: 2px 1px 6px rgba(0, 0, 0, 0.3)">
                    <div class="card-header text-white" style="background: #c08f26">Total clientes</div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <i class="fas fa-users fa-4x" style="color: #e9942a"></i>
                            </div>

                            <div class="col-8">
                                <span class="card-title" id="total_clients" style="font-size: 2em; float: right; margin-bottom: 0; margin-right: 20px">0</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card bg-light mb-3" style="max-width: 18rem; border: #b3843a 1px solid; box-shadow: 2px 1px 6px rgba(0, 0, 0, 0.3)">
                    <div class="card-header text-white" style="background: #c08f26">Total de vendas</div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <i class="fas fa-shopping-cart fa-4x" style="color: #e9942a"></i>
                            </div>

                            <div class="col-8">
                                <span class="card-title" id="total_sales" style="font-size: 2em; float: right; margin-bottom: 0; margin-right: 20px">0</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card bg-light mb-3" style="max-width: 18rem; border: #b3843a 1px solid; box-shadow: 2px 1px 6px rgba(0, 0, 0, 0.3)">
                    <div class="card-header text-white" style="background: #c08f26">Total vendas finalizadas</div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <i class="fas fa-cart-plus fa-4x" style="color: #e9942a"></i>
                            </div>

                            <div class="col-8">
                                <span class="card-title" id="total_sales-completed" style="font-size: 2em; float: right; margin-bottom: 0; margin-right: 20px">0</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card bg-light mb-3" style="max-width: 18rem; border: #b3843a 1px solid; box-shadow: 2px 1px 6px rgba(0, 0, 0, 0.3)">
                    <div class="card-header text-white" style="background: #c08f26">Total vendas pendentes</div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <i class="fas fa-cart-arrow-down fa-4x" style="color: #e9942a"></i>
                            </div>

                            <div class="col-8">
                                <span class="card-title" id="total_sales-pending" style="font-size: 2em; float: right; margin-bottom: 0; margin-right: 20px">0</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>

        <div class="row text-center">

            <div class="col-12 col-md-3">
                <div class="card bg-light mb-3" style="max-width: 18rem; border: #b3843a 1px solid; box-shadow: 2px 1px 6px rgba(0, 0, 0, 0.3)">
                    <div class="card-header text-white" style="background: #c08f26">Valor total</div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <i class="fas fa-wallet fa-3x" style="color: #e9942a"></i>
                            </div>

                            <div class="col-8">
                                <span style="float: left">R$</span>
                                <span class="card-title" id="valor_total_all" style="font-size: 1.5em; float: right; margin-bottom: 0; margin-right: 5px">1.000.000</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card bg-light mb-3" style="max-width: 18rem; border: #b3843a 1px solid; box-shadow: 2px 1px 6px rgba(0, 0, 0, 0.3)">
                    <div class="card-header text-white" style="background: #c08f26">Valor pendente</div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <i class="fas fa-credit-card fa-3x" style="color: #e9942a"></i>
                            </div>

                            <div class="col-8">
                                <span style="float: left">R$</span>
                                <span class="card-title" id="valor_total_pendente" style="font-size: 1.5em; float: right; margin-bottom: 0; margin-right: 5px">0</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-md-3">
                <div class="card bg-light mb-3" style="max-width: 18rem; border: #b3843a 1px solid; box-shadow: 2px 1px 6px rgba(0, 0, 0, 0.3)">
                    <div class="card-header text-white" style="background: #c08f26">Valor pago</div>
                    <div class="card-body">
                        <div class="row">

                            <div class="col-4">
                                <i class="fas fa-money-bill-alt fa-3x" style="color: #e9942a"></i>
                            </div>

                            <div class="col-8">
                                <span style="float: left">R$</span>
                                <span class="card-title" id="valor_total_pago" style="font-size: 1.5em; float: right; margin-bottom: 0; margin-right: 5px">0</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>

@endsection
