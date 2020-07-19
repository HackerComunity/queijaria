@extends('Management.master')

@section('content')

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-2">
                <a class="text-primary" href="{{ route('management.products.create') }}">
                    <i class="fas fa-plus-circle fa-2x"></i>
                </a>
            </div>

        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">

        <div class="table-responsive">
            <table id="table_id" class="display table table-sm table-hover table-striped">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Descrição</th>
                    <th>Quantidade</th>
                    <th>Tipo</th>
                    <th></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($paginate as $item)
                    <tr id="tr-select-tds">
                        <td>{{ $item->cod_product }}</td>
                        <td>{{ $item->descricao }}</td>
                        <td>{{ $item->qnt_atual }}</td>
                        <td>{{ $item->tipo }}</td>
                        <td>
                            <a href="{{ route('management.products.show', $item->id) }}">
                                <i class="text-primary fas fa-eye"></i>
                            </a>
                        </td>
                        @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                            <td>
                                <x-button-delete :action="route('management.products.destroy', $item->id)"/>
                            </td>
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
