<?php

namespace App\Http\Controllers\Accounts;

use App\Http\Controllers\Controller;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class LoginController extends Controller
{

    public function fakeacc(){
        Account::create([
            'username' => 'teacher',
            'password' => bcrypt('123456'),
            'fullname' => 'Nguyen Thi Co Giao',
            'email' => 'cogiao113@gmail.com',
            'sdt' => '0123456789',
            'role' => 'T'
        ]);
    }

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
