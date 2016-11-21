<?php
/**
 * User: Leonardo
 * Date: 19/11/2016
 * Time: 13:37
 */

namespace Sistema\OAuth;

use Illuminate\Support\Facades\Auth;

class Verifier
{

    public function verify($username, $password)
    {
        $credentials = [
                    'email'    => $username,
                    'password' => $password,
        ];

        if(Auth::once($credentials)){
            return Auth::user()->id;
        }

        return false;
    }

}