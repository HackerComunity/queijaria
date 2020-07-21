<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="stylesheet" href="{{ asset(mix('assets/css/style-dash.css')) }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">

    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.css"/>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        td.highlight {
            background-color: whitesmoke !important;
        }
    </style>

    @yield("csrf-tokens")

    <title>{{ $title }}</title>
    <script>
        function openMenu() {
            var box = document.getElementById('menu-lateral-mobile');
            var btn = document.getElementsByClassName('btn-action-menu-latera');
            if(box.className === "close-menu-properts") {
                box.className = "open-menu-properts";
            } else {
                box.className = "close-menu-properts"
            }
        }
    </script>

</head>
<body id="auxiliar">

<nav id="nav-controll-mobile" class="navbar navbar-expand-lg navbar-light" style=" background-color: #94610e">
    <label for="check-menu" onclick="openMenu()" class="navbar-toggler-icon btn-action-menu-latera"></label>

    <div id="menu-lateral-mobile" class="close-menu-properts">
        <div class="box-check-menu">
            <label for="check-menu" class="navbar-toggler-icon btn-action-menu-latera-dentro" onclick="openMenu()"></label>
        </div>
        <div class="img-logo">
            <a href="{{ route("management.home") }}"><img src="{{ url(asset('assets/images/logo-login-2.png')) }}" alt=""></a>
        </div>

        <div class="name-user" style="border-bottom: 1px solid white;border-top: 1px solid white">
            <div class="row p-1 pl-3">
                <div class="col-md-12">
                    Usuário: {{ $nameuser["name"] }}
                </div>
            </div>
        </div>

        <div class="sidebar-sticky pt-3">

            <ul class="" >
                <li style=" margin-left: 10px; font-weight: 600; margin-top: 10px">
                    <span class="text-white">Gestão</span>
                </li>
                <li class="">
                    <a class="" href="{{ route('management.home') }}">
                        Início
                    </a>
                </li>
                <li class="">
                    <a class="" href="{{ route('management.control.index') }}">
                        Clientes
                    </a>
                </li>
                <li class="">
                    <a class="" href="{{ route('management.sales.index') }}">
                        Vendas
                    </a>
                </li>
                <li class="">
                    <a class="" href="{{ route('management.products.index') }}">
                        Produtos
                    </a>
                </li>
                <li class="">
                    <a class="" href="{{ route('management.clients-inactives') }}">
                        Clientes inativos
                    </a>
                </li>
                <li class="">
                    <a class="" href="{{ route('management.sales-completed.sale') }}">
                        Vendas finalizadas
                    </a>
                </li>
                <li class="">
                    <a class="" href="{{ route('management.products.products-inactives') }}">
                        Produtos inativos
                    </a>
                </li>
                <li style=" margin-left: 10px; font-weight: 600; margin-top: 10px">
                    <span class="text-white">Outros</span>
                </li>
                <li class="">
                    <a class="" href="{{ route("management.user.profile") }}">
                        Perfil
                    </a>
                </li>
                @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                    <li class="">
                        <a class="" href="{{ route("management.user.all")}}">
                            Usuários
                        </a>
                    </li>
                @endif
                <li class="">
                    <a class="" href="{{ route('management.logout') }}">
                        Sair
                    </a>
                </li>
            </ul>

        </div>
    </div>

</nav>



<div class="container-fluid">

    <div class="row">

        <nav id="sidebarMenu" class="col-md-3 col-lg-3 col-xl-2 d-md-block sidebar collapse">

            <div class="img-logo">
                <a href="{{ route("management.home") }}"><img src="{{ url(asset('assets/images/logo-login-2.png')) }}" alt=""></a>
            </div>

            <div class="name-user" style="border-bottom: 1px solid white;border-top: 1px solid white">
                <div class="row p-1 pl-3">
                    <div class="col-md-12 text-white">
                        Usuário: {{ $nameuser["name"] }}
                    </div>
                </div>
            </div>

            <div class="sidebar-sticky pt-3">
                <ul class="" >
                    <li style=" margin-left: 10px; font-weight: 600; margin-top: 10px">
                        <span class="text-white">Gestão</span>
                    </li>
                    <li class="">
                        <a class="" href="{{ route('management.home') }}">
                            Início
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="{{ route('management.control.index') }}">
                            Clientes
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="{{ route('management.sales.index') }}">
                            Vendas
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="{{ route('management.products.index') }}">
                            Produtos
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="{{ route('management.clients-inactives') }}">
                            Clientes inativos
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="{{ route('management.sales-completed.sale') }}">
                            Vendas finalizadas
                        </a>
                    </li>
                    <li class="">
                        <a class="" href="{{ route('management.products.products-inactives') }}">
                            Produtos inativos
                        </a>
                    </li>
                    <li style=" margin-left: 10px; font-weight: 600; margin-top: 10px">
                        <span class="text-white">Outros</span>
                    </li>
                    <li class="">
                        <a class="" href="{{ route("management.user.profile") }}">
                            Perfil
                        </a>
                    </li>
                    @if(CheckTypeUser($nameuser->type) == "Administrador" || CheckTypeUser($nameuser->type) == "Desenvolvedor")
                        <li class="">
                            <a class="" href="{{ route("management.user.all")}}">
                                Usuários
                            </a>
                        </li>
                    @endif
                    <li class="">
                        <a class="" href="{{ route('management.logout') }}">
                            Sair
                        </a>
                    </li>
                </ul>
            </div>

        </nav>

        <main role="main" class="col-md-10 ml-sm-auto col-lg-10 col-lg-9 px-md-4">

            @yield('content')

        </main>

    </div>
</div>

<script src="{{ asset(mix('assets/js/script.js')) }}"></script>


<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<!-- Optional JavaScript -->
<!-- jQuery first, then Popper.js, then Bootstrap JS -->

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.13.1/js/all.min.js"></script>

{{--<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>--}}
{{--<script src="https://cdnjs.cloudflare.com/ajax/libs/notify/0.3.1/notify.min.js"></script>--}}

<script src="//ajax.googleapis.com/ajax/libs/jquery/1/jquery.js"></script>
<script src="//rawgit.com/notifyjs/notifyjs/master/dist/notify.js"></script>
@yield('scripts')

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.21/datatables.min.js"></script>


<script>
    $(document).ready(function () {
        $("#table_id").DataTable({
            "oLanguage" : {
                "sLengthMenu" : "Exibir _MENU_ registro",
                "sZeroRecord" : "Nenhum registro encontrado",
                "sInfo" : "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "sInfoEmpty" : "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "sInfoFiltered" : "(filtrado de _MAX_ total de entradas)"
            }
        });

        var table = $('#table_id').DataTable();

        $('#table_id tbody')
            .on( 'mouseenter', 'td', function () {
                var colIdx = table.cell(this).index().column;

                $( table.cells().nodes() ).removeClass( 'highlight' );
                $( table.column( colIdx ).nodes() ).addClass( 'highlight' );
            } );
    });
</script>


</body>
</html>
