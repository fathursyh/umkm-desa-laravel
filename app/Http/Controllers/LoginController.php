<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view("auth.login");
    }
    public function authenticate(Request $request)
{
    $validator = Validator::make($request->all(), [
        "email" => "required|email",
        "password" => "required"
    ]);

    if ($validator->passes()) {
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            
            if ($user->status === 'pending') {
                Auth::logout();
                return redirect()->route('account.login')
                    ->with('error', 'Your account is pending approval.');
            }
            
            if ($user->status === 'rejected') {
                Auth::logout();
                return redirect()->route('account.login')
                    ->with('error', 'Your registration was rejected. Reason: ' . $user->rejection_reason);
            }
            
            if ($user->role === 'admin') {
                return redirect()->route('account.dashboard');
            }
            
            return redirect()->route('account.dashboard');
        }
        
        return redirect()->route('account.login')
            ->with('error', 'Either email or password is incorrect.');
    }
    
    return redirect()->route('account.login')->withInput()->withErrors($validator);
}

    public function register()
    {
        return view('auth.register');
    }

    public function processRegister(Request $request)
    {
        $validator = Validator::make($request->all(), [
            "email" => "required|email|unique:users",
            "password" => "required|confirmed"
        ]);
        if ($validator->passes()) {
            $user = new User();
            $user->name = $request->name;
            $user->email = $request->email;
            $user->password = bcrypt($request->password);
            $user->role = 'umkm';
            $user->save();
            return redirect()->route('account.login')->with('success','Anjay Berhasil');
        } else {
            return redirect()->route('account.register')->withInput()->withErrors($validator);
        }
    }

    public function logout(Request $request){
        Auth::logout();
        return redirect()->route('account.login');
    }
}
