<?php

namespace App\Http\Controllers;

use App\Traits\ApiResponser;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    use ApiResponser;

    public function me(Request $request)
    {
        return $this->validResponse($request->user());
    }
}
