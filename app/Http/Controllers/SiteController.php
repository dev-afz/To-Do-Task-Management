<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class SiteController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function register()
    {
        return view('Auth.Register');
    }
    public function login()
    {
        return view('Auth.login');
    }

    public function postRegister(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'mobile' => 'required|digits:10',
            'email' => 'required|email',
            'password' => 'required|string',
        ]);
        // return $request->all();
        $user = User::create([
            'name' => $request->name,
            'mobile' => $request->mobile,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        return response(['message' => 'Registered successfully!']);
    }

    public function postLogin(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('status', 'invalid login details');
        }

        return redirect('user');
    }
    public function logout()
    {
        auth()->logout();

        return redirect()->route('login');
    }
}
