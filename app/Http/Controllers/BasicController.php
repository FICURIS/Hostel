<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\AuthorizationRequest;

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

    public function index()
    {
        return view('static.index');
    }

    public function submit_login(LoginRequest $request)
    {
        $data = $request->validated();

        $guestRole = Role::where('name', 'guest')->first();

        $user = User::create([
            'login' => $data['login'],
            'password' => Hash::make($data['password']),
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role_id' => $guestRole ? $guestRole->id : 1,
        ]);

        Auth::login($user);

        return redirect()->route('index')->with('succes', 'Регистрация прошла успешно!');
    }
    
    public function submit_authorization(AuthorizationRequest $request)
    {
        $data = $request->validated();

        if (Auth::attemp(['login' => $data['login'], 'password' => $data['password']]))
            {
            $request->session()->regenerate();
            return redirect()->route('index')->with('success', 'Вы успешно вошли!');
            }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль.',
        ])->onlyInput('login');
    }
}
