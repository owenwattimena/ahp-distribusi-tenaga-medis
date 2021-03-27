<?php

namespace App\Http\Controllers\auth;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\Controller;


class AuthController extends Controller
{
    //
    public function index()
    {
        return view('auth.index');
    }

    public function logout(){
        \Auth::logout();
        return redirect('/');
    }

    public function post(Request $request)
    {
        $request->validate(
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );

        $user = User::where('username', $request->username)->get()->first();
        if($user){
            if(Hash::check($request->password, $user->password))
            {
                \Auth::login($user);
                \Auth::loginUsingId($user->id);
                return redirect()->route("dashboard");
            }
        }
        $alert = [
            "tipe" => "alert-danger",
            "pesan" => "User tidak terdaftar!"
        ];
        return redirect()->back()->with($alert);

    }

}