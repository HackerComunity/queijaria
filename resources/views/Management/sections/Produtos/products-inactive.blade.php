@extends('Management.master')

@section('content')

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-3">
               <h4>Produtos inativos</h4>
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
                    <th>Lote</th>
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
                        <td>{{ (strlen($item->lote) == 2) ? $item->lote : "0".$item->lote }}</td>
                        @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                            <td>
                                <x-button-active :action="route('management.products.active-product', $item->id)"/>
                            </td>
                        @endif
                        @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                            <td>
                                <x-button-delete :action="route('management.products.delete-product', $item->id)"/>
                            </td>
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
