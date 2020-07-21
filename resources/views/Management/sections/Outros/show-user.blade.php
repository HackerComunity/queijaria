@extends("Management.master")

@section("content")
    <div class="my-3 p-3 bg-white rounded shadow-sm">
        <div class="row">

            <div class="col-4">
                <a class="text-primary" href="{{ route('management.home') }}">
                    <i class="fas fa-arrow-circle-left fa-2x"></i>
                </a>
            </div>

        </div>
    </div>

    <div class="my-3 pb-3 p-1 bg-white rounded shadow-sm">
        <div class="col-md-12 order-md-1">
            <h4 class="mb-3">Perfil</h4>
            <form id="form_element" action="{{ route('management.register.user') }}" class="needs-validation" novalidate="" method="POST">
                @csrf

                <div class="row">
                    <div class="col-12 col-md-7 mb-3">
                        <label for="name_user">Nome e Sobrenome:</label>
                        <input type="text" class="form-control" id="name_user" name="name_user" value="{{ $nameuser["name"] }}" required="">
                    </div>
                    <div class="col-12 col-md-5 mb-3">
                        <label for="username">Usuário:</label>
                        <input type="text" class="form-control" id="username" name="username" value="{{ $nameuser["user"] }}" required="">
                    </div>
                    <div class="col-12 col-md-7 mb-3">
                        <label for="password">Senha:</label>
                        <input type="text" class="form-control" id="password" name="password" value="{{ decrypt($paginate->password) }}" required="">
                    </div>
                    <div class="mb-12 col-md-5 col-12">
                        <label for="nivel">Nível:</label>
                        <select class="custom-select d-block w-100" id="nivel" name="nivel" required="">
                            <option value="">Selecione...</option>
                            <option value="2" {{ ($paginate->type == '2' ? 'selected' : '')  }}>Desenvolvedor</option>
                            <option value="0" {{ ($paginate->type == '0' ? 'selected' : '')  }}>Administrador</option>
                            <option value="1" {{ ($paginate->type == '1' ? 'selected' : '')  }}>Vendedor</option>
                        </select>
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
                var name_user = document.getElementById("name_user");
                var username = document.getElementById("username");
                var password = document.getElementById("password");
                var nivel = document.getElementById("nivel");
                if(name_user.value.length <= 0) {
                    $("#name_user").notify("Por favor, informe um nome para o usuário!", "error");
                }
                if(username.value.length <= 0) {
                    $("#username").notify("Por favor, insira um nome de usuário!", "error");
                }
                if(password.value.length <= 0) {
                    $("#password").notify("Por favor, informe uma senha!", "error");
                }
                if(nivel.selectedIndex === 0 || nivel.selectedIndex === "") {
                    $("#nivel").notify("Por favor, selecione o nível do usuário!", "error");
                }
                if(name_user.value.length > 0
                    && username.value.length > 0
                    && password.value.length > 0
                    && nivel.selectedIndex !== 0) {
                    $("form").submit();
                }
            })
        })
    </script>
@endsection
