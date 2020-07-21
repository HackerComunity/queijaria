@extends('Management.master')

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

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="col-md-12 order-md-1">
        <h4 class="mb-3">Novo cliente</h4>
        <form action="{{ route('management.create.cliente') }}" class="needs-validation" novalidate="" method="POST">
            @csrf

            <div class="row">

                <div class="col-4 col-md-2 mb-3">
                    <label for="cod_client">Código:</label>
                    <input type="text" class="form-control" id="cod_client" name="cod_client" value="{{ GeraCodigClient() }}">
                </div>

                <div class="col-8 col-md-7 mb-3">
                    <label for="name_client">Nome e Sobrenome:</label>
                    <input type="text" class="form-control" id="name_client" name="name_client" value="" required="">
                </div>

                <div class="col-6 col-md-3 mb-3">
                    <label for="cep">Cep: </label>
                    <input type="text" class="form-control" id="cep" name="cep" required="">
                </div>

                <div class="col-md-4 col-6 mb-3">
                    <label for="cidade">Cidade:</label>
                    <input type="text" class="form-control" id="cidade"  name="cidade" required="">
                </div>

                <div class="col-md-4 col-12 mb-3">
                    <label for="endereco">Endereço: </label>
                    <input type="text" class="form-control" id="endereco" name="endereco" required="">
                </div>

                <div class="col-md-4 col-12 mb-3">
                    <label for="estado">Estado: </label>
                    <input type="text" class="form-control" id="estado" name="estado" required="">
                </div>

            </div>

            <hr class="mb-4">

            <button class="btn btn-primary btn-lg btn-block" id="save_submit" type="submit">Cadastrar</button>
        </form>
    </div>
    </div>

@endsection

@section('scripts')
    <script>
        $(document).ready(function () {
            $("#save_submit").click(function (e) {
                e.preventDefault();
                var name_client = document.getElementById("name_client");
                var cidade = document.getElementById("cidade");
                console.log(name_client.value)
                if(name_client.value.length <= 0) {
                    $("#name_client").notify("Por favor, informe um nome para o cliente!", "error");
                }
                if(cidade.value.length <= 0) {
                    $("#cidade").notify("Por favor, informe a cidade do cliente!", "error");
                }
                if(name_client.value.length > 0 && cidade.value.length > 0) {
                    $("form").submit();
                }
            })
        })
    </script>
@endsection
