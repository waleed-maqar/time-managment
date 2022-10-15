<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\UserRegisterRequest;
use App\Models\User;
use GuzzleHttp\Promise\Create;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
    public function register()
    {
        return view('authintication.user.register');
    }
    public function store(UserRegisterRequest $request)
    {
        $request = $request->except('_token', 'password_confirmation');
        $request['password'] = bcrypt($request['password']);
        $user = User::create($request);
        Auth::login($user);
        return redirect(route('homepage'));
    }

    public function login()
    {
        return view('authintication.user.login');
    }
    public function userLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $creds = [
            'email' => $request->email,
            'password' => $request->password
        ];

        if (Auth::attempt($creds, $request->remember)) {
            return redirect(route('homepage'));
        } else {
            return redirect()->back()->with('failed', 'wrong E-mail or Password');
        }
    }

    public function logout()
    {

        $user = User::find(Auth::id());
        Auth::logout();
        $user->remember_token = null;
        $user->save();
        return redirect(url('login'));
    }
}