@extends('Management.master')

@section('content')

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-12 col-md-9">
                <h4 >Vendas pendentes</h4>
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
                @php
                    $total_vendas = 0;
                    $calc_total_pedido = 0;
                    $calc_total_valor_pedido = 0;
                @endphp
                @foreach($paginate as $item)
                    @php
                        $total_vendas += 1;
                        $calc_total_pedido += intval($item->quantidade);
                        $calc_total_valor_pedido += floatval(str_replace("R$ ", "", $item->valor_venda));
                    @endphp
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
                            <a href="{{ route('management.sales.show', $item->id) }}">
                                <i class="text-primary fas fa-eye"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach

                </tbody>
                <tfoot>
                    <tr>
                        <th>Total</th>
                        <th>{{ $total_vendas }} - Vendas</th>
                        <th></th>
                        <th>{{ $calc_total_pedido }}</th>
                        <th>{{ "R$ $calc_total_valor_pedido" }}</th>
                        <th></th>
                        <th></th>
                        <th></th>
                        <th></th>
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>
@endsection
