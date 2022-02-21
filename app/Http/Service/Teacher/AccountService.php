<?php

namespace App\Http\Service\Teacher;

use App\Models\Account;
use Exception;
use Illuminate\Notifications\Action;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountService
{

    public function getusers()
    {
        return Account::where('id', '<>', Auth::user()->id)->get();
        // return Account::all();
    }
    public function getCurrentUser()
    {
        return Account::where('id', Auth::user()->id)->get()->first();
    }
    public function getuser($request)
    {
        return Account::where('id', '=', $request->input('id'))->get()->first();
    }

    public function add($request)
    {
        try {
            Account::create([
                'username' => (string)$request->input('username'),
                'password' => bcrypt((string)$request->input('password')),
                'fullname' => (string)$request->input('fullname'),
                'email' => (string)$request->input('email'),
                'sdt' => (string)$request->input('phonenumber'),
                'role' => 'S'
            ]);

            Session::flash('success', 'Add user successfully!');
        } catch (Exception $e) {
            // Session::flash('error',$e->getMessage());
            Session::flash('error', 'Cannot create account!');
            return false;
        }
        return true;
    }

    public function update($request)
    {
        if (Auth::user()->role === 'T') {
            try {
                Account::where('id', $request->input('id'))->update([
                    'username' => (string)$request->input('username'),
                    'password' => bcrypt((string)$request->input('password')),
                    'fullname' => (string)$request->input('fullname'),
                    'email' => (string)$request->input('email'),
                    'sdt' => (string)$request->input('phonenumber'),

                ]);
                Session::flash('success', 'Update account successfully!');
                return true;
            } catch (Exception $ex) {
                Session::flash('error', 'Cannot update account!');
                return false;
            }
        } else {
            try {
                Account::where('id', $request->input('id'))->update([
                    'fullname' => (string)$request->input('fullname'),
                    'email' => (string)$request->input('email'),
                    'sdt' => (string)$request->input('phonenumber'),
                ]);
                Session::flash('success', 'Update account successfully!');
                return true;
            } catch (Exception $ex) {
                Session::flash('error', 'Cannot update account!');
                return false;
            }
        }
    }



    public function destroy($request)
    {
        $id = $request->input('id');
        $user = Account::where('id', $id)->first();
        if ($user) {
            Account::where('id', $id)->delete();
            Session::flash('success', 'Deleted account!');
            return true;
        }
        Session::flash('error', 'Cannot delete account!');
        return false;
    }
}