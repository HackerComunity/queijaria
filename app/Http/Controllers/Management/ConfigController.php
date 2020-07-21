<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ConfigController extends Controller
{
    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function profile() {
        return view('Management.sections.Outros.profile')->with([
            "title" => "Queijo Caseiro | Perfil",
            "nameuser" => Auth::user()
        ]);
    }

    public function newUserForm()
    {
        return view('Management.sections.Outros.create-user')->with([
            "title" => "Queijo Caseiro | Novo usuário",
            "nameuser" => Auth::user()
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function registerUser(Request $request) {
        $data = [
            "name" => $request->name_user,
            "user" => $request->username,
            "password" => bcrypt($request->password),
            "type" => $request->nivel,
        ];
        User::create($data);

        return redirect()->route("management.user.all");
    }

    public function updateUser($id, Request $request)
    {
        $data = [
            "name" => $request->name_user,
            "user" => $request->username,
            "password" => bcrypt($request->password),
            "type" => $request->nivel,
        ];
        User::where('id', $id)->update($data);

        return redirect()->route("management.user.profile");
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function usersAll()
    {
        $users = User::all();
        return view('Management.sections.Outros.all-users')->with([
            "title" => "Queijo Caseiro | Todos os usuários",
            "paginate" => $users,
            "nameuser" => Auth::user()
        ]);
    }

    public function deleteUser($id)
    {
        if (CheckTypeUser(Auth::user()->type) == "Administrador" || CheckTypeUser(Auth::user()->type) == "Desenvolvedor") {
            User::destroy($id);
        }
        return redirect()->back()->with([
            "message" => "Usuário excluido com sucesso!"
        ]);
    }
}
