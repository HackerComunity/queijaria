@extends('Management.master')

@section('content')
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-12 col-md-9">
                <a class="text-primary" href="{{ route('management.sales.index') }}">
                    <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>
            </div>

        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-12 col-md-12">

                    <div class="col-md-12 order-md-1">
                        <form action="{{ route('management.sales.update', $paginate->id) }}" class="needs-validation" novalidate="" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="row">
                                <div class="col-md-2 col-6 mb-3">
                                    <label for="codigo_venda">Código da venda:</label>
                                    <input type="text" class="form-control" id="codigo_venda" name="codigo_venda" value="{{ $paginate->cod_venda }}" required="">
                                </div>

                                <div class="col-md-4 col-6 mb-3">
                                    <label for="vendedor">Vendedor:</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" id="vendedor" required="" name="vendedor" value="{{ $paginate->vendedor }}">
                                    </div>
                                </div>

                                <div class="col-md-6 col-12 mb-3">
                                    <label for="name_client">Nome do Cliente:</label>
                                    <input type="text" class="form-control" id="name_client" name="name_client" value="{{ $paginate->nome_client }}" required="">
                                    <input type="hidden" name="cod_client" value="{{ $paginate->cod_client }}">
                                </div>

                            </div>

                            <div class="row">
                                <div class="mb-3 col-6">
                                    <label for="data_venda">Data da venda:</label>
                                    <input type="text" class="form-control" id="data_venda" name="data_venda" value="{{ date("d/m/Y", strtotime($paginate->data_venda)) }}">
                                </div>

                                <div class="mb-3 col-6">
                                    <label for="quantidade">Quantidade:</label>
                                    <input type="text" class="form-control" id="quantidade" name="quantidade" value="{{ $paginate->quantidade }}">
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-md-3 mb-3 col-6">
                                    <label for="valor_venda">Valor da venda:</label>
                                    <input type="text" class="form-control" id="valor_venda" name="valor_venda" value="{{ $paginate->valor_venda }}">
                                </div>

                                <div class="col-md-3 col-6 mb-3">
                                    <label for="cc-name">Lote:</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" value="{{ (count_chars($paginate->lote) == 2) ? $paginate->lote : "0".$paginate->lote }}">
                                </div>

                                <div class="col-md-6 col-12 mb-3">
                                    <label for="cc-name">Situação:</label>
                                    <input type="text" class="form-control" id="cc-name" placeholder="" value="{{ CheckPending($paginate->tipo) }}">
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label for="observacoes">Observações: </label>
                                    <textarea class="form-control" id="observacoes" name="observacoes">{{ $paginate->observacoes }}</textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-6">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Dar baixar</button>
                                </div>

                                <div class="col-6">
                                    <a href="{{ route('management.sales.index') }}" class="btn btn-primary btn-lg btn-block">Voltar</a>
                                </div>

                            </div>

                        </form>
                    </div>

            </div>

        </div>
    </div>

@endsection
