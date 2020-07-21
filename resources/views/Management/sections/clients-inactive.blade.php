@extends("Management.master")


@section('content')
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-5">
                <h4>Clientes inativos</h4>
            </div>

        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="table-responsive">
            <table id="table_id" class="display table table-sm table-hover table-striped">
                <thead>
                <tr>
                    <th scope="col">Código</th>
                    <th scope="col">Nome</th>
                    <th scope="col">Pendente</th>
                    <th scope="col">Pagos</th>
                    <th scope="col">Total</th>
                    <th scope="col">Valor pendente</th>
                    <th scope="col">Valor pago</th>
                    {{--                        <th scope="col">Valor total</th>--}}
                    @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                        <th scope="col"></th>
                    @endif
                    @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                        <th scope="col"></th>
                    @endif
                </tr>
                </thead>
                <tbody>
                @foreach($paginate as $item)
                    <tr>
                        <td>{{ $item->cod_client }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->qnt_pendente }}</td>
                        <td>{{ $item->qnt_pago }}</td>
                        <td>{{ CalcularTotalQueijoCliente($item->qnt_pendente, $item->qnt_pago)  }}</td>
                        <td>{{ $item->valor_pendente }}</td>
                        <td>{{ $item->valor_ja_pago }}</td>
                        {{--                        <td>{{ $item->valor_todos_pedidos }}</td>--}}
                        @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                            <td>
                                <x-button-active :action="route('management.active-client', $item->id)"/>
                            </td>
                        @endif
                        @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                            <td>
                                <x-button-delete :action="route('management.delete-client', $item->id)"/>
                            </td>
                        @endif
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>

    <div class="my-3 p-3 bg-white rounded shadow-sm">

    </div>

@endsection
