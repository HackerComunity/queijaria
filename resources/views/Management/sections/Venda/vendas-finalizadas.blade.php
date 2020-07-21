@extends('Management.master')

@section('content')

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-12 col-md-9">
                <h4 >Vendas finalizadas</h4>
            </div>

        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">

        <div class="table-responsive">
            <table id="table_id" class="display table table-sm table-hover table-striped">
                <thead>
                <tr>
                    <th>Código</th>
                    <th>Nome</th>
                    <th>Vendedor</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Situação</th>
                    <th>Lote</th>
                    <th>Data</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($paginate as $item)
                    <tr id="tr-select-tds">
                        <td>{{ $item->cod_venda }}</td>
                        <td>{{ $item->nome_client }}</td>
                        <td>{{ $item->vendedor }}</td>
                        <td>{{ $item->quantidade }}</td>
                        <td>{{ $item->valor_venda }}</td>
                        <td>{{ CheckPending($item->tipo) }}</td>
                        <td>{{ (count_chars($item->lote) == 2) ? $item->lote : "0".$item->lote }}</td>
                        <td>{{ date('d/m/Y', strtotime($item->data_venda)) }}</td>
                        <td>
                            <a href="{{ route('management.show-sales-completed', $item->id) }}">
                                <i class="text-primary fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
