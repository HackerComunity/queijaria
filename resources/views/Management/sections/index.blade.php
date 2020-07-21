@extends("Management.master")


@section('content')
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-2">
                <a class="text-primary" href="{{ route('management.control.create') }}">
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
                        <th scope="col">Código</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Pendente</th>
                        <th scope="col">Pagos</th>
                        <th scope="col">Total</th>
                        <th scope="col">Valor pendente</th>
                        <th scope="col">Valor pago</th>
                        <th scope="col">Valor total</th>
                        <th scope="col"></th>
                        <th></th>
                        @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                            <th scope="col"></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($paginate as $item)
                    <tr>
                        <td c>{{ $item->cod_client }}</td>
                        <td>{{ $item->nome }}</td>
                        <td>{{ $item->qnt_pendente }}</td>
                        <td>{{ $item->qnt_pago }}</td>
                        <td>{{ CalcularTotalQueijoCliente($item->qnt_pendente, $item->qnt_pago)  }}</td>
                        <td>{{ $item->valor_pendente }}</td>
                        <td>{{ $item->valor_ja_pago }}</td>
                        <td>{{ $item->valor_todos_pedidos }}</td>
                        <td>
                            <a href="{{ route('management.control.show', $item->id) }}">
                                <i class="text-primary fas fa-cart-plus"></i>
                            </a>
                        </td>
                        @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                            <td>
                                <x-button-delete :action="route('management.control.destroy', $item->id)"/>
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
