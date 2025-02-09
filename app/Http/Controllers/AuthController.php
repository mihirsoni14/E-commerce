<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\password;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $request->password,
        ]);
        return redirect()->route('admin.login');
    }

    public function login(Request $request)
    {

        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        $data = Auth::attempt($credentials);
        if ($data) {
            return redirect()->route('dashbord');
        } else {
            return redirect()->back()->withErrors(['error' => 'Invalid Credentials']);
        }

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('admin.login');
    }
}
