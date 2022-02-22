<?php

namespace App\Http\Service\Teacher;

use App\Models\AccountAss;
use App\Models\AccountChallenge;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class AccountChallengeService
{
    public function find(Request $request)
    {
        return AccountChallenge::join('accounts', 'id', '=', 'account_challenges.account_id')
            ->where('account_challenges.challenge_id', $request->input('id'))->get(['account_challenges.*', 'accounts.fullname']);
    }

    public function add($request)
    {
        $points = 0;
        $challengeService = new ChallengeService();
        $challenge = $challengeService->findOne($request);
        $challengeId =  (string)$challenge->id;

        $content = '';

        $fileName = $challengeId.'_'.$request->input('answer').'.txt';
        $file_url = '/app/uploads/challenges/' . $fileName;
        $file_path = storage_path().$file_url;
        $isExists = file_exists($file_path);
        


         
        if ($isExists) {
            
                //$content = file_get_contents(base_path('storage/'.$file_url));
                $content = file_get_contents($file_path);
                $points = 100;
        }

        try {
            AccountChallenge::create([
                'account_id' => Auth::user()->id,
                'challenge_id' => $request->input('id'),
                'points' => $points,
            ]);
        } catch (Exception $e) {
            // Session::flash('error',$e->getMessage());
            Session::flash('error', 'Cannot Submit!');
        }
        return $content;
    }
}
