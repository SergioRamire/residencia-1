<?php

namespace App\Http\Responses;

use Laravel\Fortify\Contracts\LoginResponse as LoginResponseContract;

class LoginResponse implements LoginResponseContract
{
    /**
     * Create an HTTP response that represents the object.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function toResponse($request)
    {
        /* Devuelve un arreglo, entonces obtenemos el único elemento */
        $role = auth()->user()->getRoleNames()[0];

        return redirect()->intended($role === 'super-admin' ? route('dashboard') : route("$role.dashboard"));
    }
}
