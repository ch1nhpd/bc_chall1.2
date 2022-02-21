<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{
    public function index(){
        return view('login',[
            'title' => 'Login'
        ]);
    }

    public function process(Request $request){
        //dd($request->input());
        $this->validate($request,[
                'username' => 'required|min:5|max:255|alpha_dash',
                'password' => 'required|min:5|max:255'
            ]);

        if(Auth::attempt([
                'username' => $request->input('username'),
                'password' => $request -> input('password')
            ], $request->input('remember'))){
            return redirect()->route('home');
        }
        Session::flash('error','Invalid username or password!');
        return redirect()->back();
    }
}
