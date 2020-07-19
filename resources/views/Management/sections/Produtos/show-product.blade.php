@extends('Management.master')

@section('content')
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-12 col-md-9">
                <a class="text-primary" href="{{ route('management.products.index') }}">
                    <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>
            </div>

        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-12 col-md-12">


                <div class="col-md-12 order-md-1">
                    <form action="{{ route('management.products.update', $paginate->id) }}" class="needs-validation" novalidate="" method="POST">
                        @csrf
                        @method("PUT")
                        <div class="row">
                            <div class="col-md-3 col-7 mb-3">
                                <label for="codigo_produto">Código do produto:</label>
                                <input type="text" class="form-control" id="codigo_produto" name="codigo_produto" value="{{ $paginate->cod_product }}" required="">
                            </div>

                            <div class="mb-3 col-5 col-md-3">
                                <label for="quantidade">Quantidade atual:</label>
                                <input type="text" class="form-control" id="quantidade" name="quantidade" value="{{ $paginate->qnt_atual }}" required="">
                            </div>

                            <div class="mb-3 col-md-6 col-12">
                                <label for="tipo">Tipo:</label>
                                <input type="text" class="form-control" id="tipo" name="tipo" value="{{ $paginate->tipo }}" required="">
                            </div>

                            <div class="mb-3 col-6">
                                <label for="desc">Descrição</label>
                                <input type="text" class="form-control" id="desc" name="desc" value="{{ $paginate->descricao }}" required="">
                            </div>

                            <div class="mb-3 col-6">
                                <label for="adicionar">Adicionar:</label>
                                <input type="text" class="form-control" id="adicionar" name="adicionar" value="" required="">
                            </div>

                        </div>

                        <div class="row">
                            <div class="col-6">
                                <button class="btn btn-primary btn-lg btn-block" type="submit">Atualizar</button>
                            </div>

                            <div class="col-6">
                                <a href="{{ route('management.products.index') }}" class="btn btn-primary btn-lg btn-block">Voltar</a>
                            </div>

                        </div>

                    </form>
                </div>

            </div>

        </div>
    </div>

@endsection
