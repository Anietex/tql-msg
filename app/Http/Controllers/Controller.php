<?php

namespace App\Http\Controllers;

use App\Events\UserCreated;
use App\Models\User;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    protected function createUser($email, $roleId){
        $password = Str::random(6);

        $user = User::create([
            'email' => $email,
            'password' => bcrypt($password),
            'role_id'  => $roleId
        ]);

        UserCreated::dispatch($user, $password);

        return $user;
    }
}
