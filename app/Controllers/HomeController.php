<?php

namespace App\Controllers;

use App\Responses\JsonResponse;

class HomeController
{
    /**
     * index
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        return new JsonResponse(200, []);
    }
}
