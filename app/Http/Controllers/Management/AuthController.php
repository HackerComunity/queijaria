<?php

namespace App\Http\Controllers\Management;

use App\Http\Controllers\Controller;
use App\Support\Login;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function home()
    {
        echo view('Management.sections.home')->with([
            "title" => "Queijaria Ricota | Início",
            "nameuser" => Auth::user()
        ]);
    }

    public function saveuser()
    {
	    $user = new User();
	    $user->name = "Luan Santos";
	    $user->user = "luan";
	    $user->password = '$2a$12$HZfQKgA9G8965dx7PAcCU.VRZBJ98vuZ/JG8t8XlP0yvKx4Uz/jTe';	    
	    $user->type = 0;
	    $user->save();
    }


    /**
     *
     */
    public function login() {
        echo view("Front.index")->with([
            "title" => "Queijo Caseiro | Login",
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function loginAuth(Request $request)
    {
        /**
         * Checando dados do array...
         * Se existir alguma posição em braco, será gerado uma mensagem de erro...
         */
        if (in_array('', $request->only("username", "password"))) {
            return redirect()->route('management.login');
        }

        $credentials = [
            'user' => $request->username,
            'password' => $request->password
        ];

        if (!Auth::attempt($credentials)) {
            return redirect()->route('management.login');
        }

        $user = User::where('user', $credentials["user"])->first();
        $this->username = $user->name;
        return redirect()->route('management.home');
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        Auth::logout();
        return redirect()->route('management.login');
    }
}
