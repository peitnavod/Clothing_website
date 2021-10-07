<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class AdminController extends Controller
{
    public function loginAdmin(){
        if(Auth::check())
        {
            return redirect()->to('home');
        }
        return view('login');
    }
    public function postLoginAdmin(Request $request){
            if(Auth::attempt([
                'email' => $request->email,
                'password' => $request->password
            ]))
            {
                return redirect()->to('home');
            }
        else{
            return view('login');
        }

    }
}
