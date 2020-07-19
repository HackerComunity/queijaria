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

    @if($errors->all())
        @foreach($errors->all() as $error)
            {{ Mensagem($error, "alert-danger") }}
        @endforeach
    @endif

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-12 col-md-12">

                <div class="col-md-12 order-md-1">
                        <form action="{{ route('management.products.store') }}" class="needs-validation" novalidate="" method="POST">
                            @csrf

                            <div class="row">
                                <div class="col-md-3 col-7 mb-3">
                                    <label for="codigo_produto">Código do produto:</label>
                                    <input type="text" class="form-control" id="codigo_produto" name="codigo_produto" value="{{ GeraCodigProduct() }}" required="">
                                </div>

                                <div class="mb-3 col-5 col-md-3">
                                    <label for="quantidade">Quantidade:</label>
                                    <input type="text" class="form-control" id="quantidade" name="quantidade" value="" required="">
                                </div>

                                <div class="mb-3 col-md-6 col-12">
                                    <label for="tipo">Tipo:</label>
                                    <input type="text" class="form-control" id="tipo" name="tipo" value="" required="">
                                </div>

                                <div class="mb-3 col-12">
                                    <label for="desc">Descrição</label>
                                    <input type="text" class="form-control" id="desc" name="desc" value="" required="">
                                </div>

                            </div>

                            <div class="row">

                                <div class="col-6">
                                    <button class="btn btn-primary btn-lg btn-block" type="submit">Criar</button>
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
