<?php

namespace App\Policies;

use App\Clients;
use App\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class AdminPolice
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function adminAction(User $user)
    {
        if ($user->type == "Administrator" or  $user->type == "Desenvolvedor") return true;
    }
}
