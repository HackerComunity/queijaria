@extends('Management.master')

@section('content')

    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-2">
                <a class="text-primary" href="{{ route('management.user.new') }}">
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
                    <th>Nome</th>
                    <th>Usuário</th>
                    <th>Nivel</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($paginate as $item)
                    <tr id="tr-select-tds">
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->user }}</td>
                        <td>{{ CheckTypeUser($item->type) }}</td>
                        <td>
                            <x-button-delete :action="route('management.user.delete', $item->id)"/>
                        </td>
                    </tr>
                @endforeach

                </tbody>
            </table>
        </div>
    </div>
@endsection
