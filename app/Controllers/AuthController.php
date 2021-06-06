<?php

namespace App\Controllers;

use App\Responses\HttpResponse;

class AuthController
{
    public function showLogin(): HttpResponse
    {
        return new HttpResponse(200, 'Auth/Login', 'Front');
    }

    public function login(): void
    {
    }
}
