@extends("Management.master")

@section('content')
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-4">
                <a class="text-primary" href="{{ route('management.control.index') }}">
                    <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>
            </div>

        </div>
    </div>

    @if($errors->all())
        @foreach($errors->all() as $error)
            {{ Mensagem($error,"alert-danger") }}
        @endforeach
    @endif
    <div class="row" style="margin: 30px 2px">
                <div class="col-md-12 order-md-1">
                    <h4 class="mb-3">Nova venda</h4>

                    <form action="{{ route('management.control.store') }}" class="needs-validation" method="POST">
                        @csrf

                        <div class="row">
                            <div class="col-md-2 col-6 mb-3">
                                <label for="codigo_venda">Código da venda:</label>
                                <input type="text" class="form-control" id="codigo_venda" name="codigo_venda" value="{{ GeraCodigVenda() }}" required="">
                            </div>

                            <input type="text" hidden name="cod_client" value="{{ $client->id }}">
                            <input type="text" hidden name="codigo_client" value="{{ $client->cod_client }}">

                            <div class="col-md-4 col-6 mb-3">
                                <label for="vendedor">Vendedor:</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="vendedor" required="" name="vendedor" value="{{ $nameuser["name"] }}">
                                </div>
                            </div>

                            <div class="col-md-6 col-12 mb-3">
                                <label for="name_client">Nome do Cliente:</label>
                                <input type="text" class="form-control" id="name_client" name="name_client" value="{{ $client->nome }}" required="">
                            </div>

                        </div>
                        <hr class="mb-4">

                        <h4 class="mb-4">Financeiro</h4>

                        <div class="row">

                            <div class="col-4 col-md-2 mb-3">
                                <label for="adicionar">Adicionar:</label>
                                <input type="text" class="form-control" id="adicionar" name="adicionar">
                            </div>

                            <div class="col-4 col-md-2 mb-3">
                                <label for="qnt_pendente">Pendentes:</label>
                                <input type="text" class="form-control" id="qnt_pendente" value="{{ $client->qnt_pendente }}" name="qnt_pendente" required="">
                            </div>

                            <div class="col-4 col-md-1 mb-3">
                                <label for="total_pagos">Pagos:</label>
                                <input type="text" class="form-control" id="total_pagos" name="total_pagos" value="{{ $client->qnt_pago }}" required="">
                            </div>

                            <div class="mb-3 col-md-2 col-12">
                                <label for="tipo_produto">Tipo:</label>
                                <select class="custom-select d-block w-100" id="tipo_produto" name="tipo_produto" required="">
                                    <option value="">Selecione...</option>
                                   @foreach($products as $prod)
                                        <option value="{{ $prod->tipo }}">{{ $prod->tipo }}</option>
                                   @endforeach
                                </select>
                            </div>

                            <div class="col-12 col-md-3 mb-3">
                                <label for="total_todos_pedidos">Quantidade de todos os pedidos:</label>
                                <input type="text" class="form-control" id="total_todos_pedidos" name="total_todos_pedidos" value="{{ $client->qnt_total }}" required="">
                            </div>

                            <div class="col-md-2 col-12 mb-3">
                                <label for="valor_total_pendente">Total pendente:</label>
                                <input type="text" class="form-control" id="valor_total_pendente" name="valor_total_pendente" value="{{ $client->valor_pendente }}" required="">
                            </div>

                        </div>

                        <div class="row">

                            <div class="col-md-2 col-6 mb-3">
                                <label for="valor_total_pagos">Total já pagos:</label>
                                <input type="text" class="form-control" id="valor_total_pagos" name="valor_total_pagos" value="{{ $client->valor_ja_pago }}" required="">
                            </div>

                            <div class="col-6 col-md-3 mb-3">
                                <label for="valor_unitario">Valor unitário:</label>
                                <input type="text" class="form-control" id="valor_unitario" name="valor_unitario" required="">
                            </div>

                            <div class="col-md-3 col-6 mb-3">
                                <label for="qnt_compra">Quantidade:</label>
                                <input type="text" class="form-control" id="qnt_compra" name="qnt_compra" value="0">
                            </div>

                            <div class="col-md-2 col-6 mb-3">
                                <label for="valor_da_venda">Valor da venda:</label>
                                <input type="text" class="form-control" id="valor_da_venda" name="valor_da_venda" value="R$ 0">
                            </div>

                            <div class="col-md-2 btn-calcular-vendas">
                                <a class="btn btn-primary text-white btn-block" onclick="calcular()">Calcular</a>
                            </div>

                        </div>

                        <hr class="mb-4">

                        <h4 class="mb-4">Outros</h4>

                        <div class="row">
                            <div class="col-md-6 col-12 mb-3">
                                <label for="observacoes">Observações sobre a venda:</label>
                                <textarea class="form-control" name="observacoes" id="observacoes" rows="4" required=""></textarea>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="col-md-12 col-12 mb-3">
                                    <label for="data_venda">Selecione a data:</label>
                                    <input type="date" class="form-control" id="data_venda" name="data_venda" value="" required="">
                                </div>
                                <div class="col-12 col-md-12 mb-3">
                                    <label for="lote">Lote da venda:</label>
                                    <input type="text" class="form-control" id="lote" name="lote" required="">
                                </div>
                            </div>
                        </div>

                        <hr class="mb-4">

                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Finalizar</button>
                            </div>
                            <div class="col-6">
                                <a href="{{ route('management.control.index') }}" class="btn btn-primary btn-lg btn-block">Cancelar</a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>
@endsection

@section('scripts')
@endsection
