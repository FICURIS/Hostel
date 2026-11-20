<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\LoginRequest;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class BasicController extends Controller
{
    public function register()
    {
        return view('static.register');
    }
    
    public function login()
    {
        return view('static.login');
    }

    public function index()
    {
        $rooms = \App\Models\Room::with('beds')->get();
    
        $reviews = \App\Models\Review::with('user')->latest()->take(5)->get();
    
        return view('static.index', compact('rooms', 'reviews'));
    }

    public function submit_register(RegisterRequest $request)
    {
        $data = $request->validated();

        $guestRole = Role::where('name', 'guest')->first();

        $user = User::create([
            'login' => $data['login'],
            'password' => ($data['password']),
            'surname' => $data['surname'],
            'name' => $data['name'],
            'middlename' => $data['middlename'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'role_id' => $guestRole ? $guestRole->id : 1,
        ]);

        Auth::login($user);

        return redirect()->route('index');
    }

    public function submit_login(LoginRequest $request)
    {
        $data = $request->validated();

        if (Auth::attempt(['login' => $data['login'], 'password' => $data['password']]))
            {
            $request->session()->regenerate();
            return redirect()->route('index');
            }

        return back()->withErrors([
            'login' => 'Неверный логин или пароль.',
        ])->onlyInput('login');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('index');
    }
}
