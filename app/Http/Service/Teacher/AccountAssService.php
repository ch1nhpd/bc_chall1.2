<?php

namespace App\Http\Service\Teacher;

use App\Models\AccountAss;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountAssService
{
    public function find(Request $request){
        return AccountAss::join('accounts','id','=','account_asses.account_id')
            ->where('account_asses.assignment_id',$request->input('id'))->get(['account_asses.*','accounts.fullname']);
    }

    public function findSubmited(Request $request){
        return AccountAss::where('account_id',Auth::user()->id)
                        ->where('assignment_id',$request->input('id'))
                        ->get()->first();
    }

    public function add($request)
    {
        try {
            $file = $request->file('file_upload');
            $file->storeAs('uploads', $file->getClientOriginalName()); //public/uploads
            AccountAss::create([
                'assignment_id' => (int)$request->input('id'),
                'link_file' => (string)$file->getClientOriginalName(),
                'account_id' => (int)Auth::user()->id,
            ]);
            Session::flash('success', 'Submited!');
        } catch (Exception $e) {
            Session::flash('error',$e->getMessage());
            // Session::flash('error', 'Cannot Submit!');
        }
    }

}