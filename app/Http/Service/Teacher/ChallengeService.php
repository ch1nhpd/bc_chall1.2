<?php

namespace App\Http\Service\Teacher;

use App\Models\Challenge;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChallengeService
{

    public function getAll(){
        return Challenge::all();
    }

    public function findOne($request)
    {
        return Challenge::where('id', $request->input('id'))->get()->first();
    }

    public function add($request){
        try {
            $file = $request->file('file_upload');
            $fileName = $file->getClientOriginalName();
            if (!preg_match ("/^[a-z A-z]*$/", pathinfo($fileName, PATHINFO_FILENAME)) ){  
                Session::flash('error', 'Invalid File Name!');
                return false;
            }
            
            $challenge = Challenge::create([
                'description' => (string)$request->input('description'),
                'hint' => (string)$request->input('hint'),
                // 'linkfile' => (string)pathinfo($fileName, PATHINFO_FILENAME),
                'account_id' => (int)Auth::user()->id,
            ]); 
            $challengeId = $challenge->id;
            $file->storeAs('uploads/challenges', $challengeId.'_'.$fileName); //public/uploads/challenges

            Session::flash('success', 'Created Challenge!');
            return true;
        } catch (Exception $e) {
            Session::flash('error',$e->getMessage());
            // Session::flash('error', 'Cannot create Challenge!');
            return false;
        }
    }

    public function destroy($request)
    {
        try {
            $id = $request->input('id');
            Challenge::where('id', $id)->delete();
            Session::flash('success', 'Deleted Challenge!');
        } catch (Exception $ex) {
            Session::flash('error', 'Cannot delete Challenge!');
        }
    }

}
