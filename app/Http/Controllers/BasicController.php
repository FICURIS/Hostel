<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Requests\LoginRequest;
use App\Http\Controllers\Requests\AuthorizationRequest;

class BasicController extends Controller
{
    public function login()
    {
        return view('static.login');
    }

    public function authorization()
    {
        return view('static.authorization');
    }

    public function submit_login(LoginRequest $request)
    {
        $data = $request->validated();
    }
    
    public function submit_authorization(AuthorizationRequest $request)
    {
        $data = $request->validated();
    }
}
