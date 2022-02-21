<?php

namespace App\Http\Service\Teacher;

use App\Models\AccountAss;
use App\Models\AccountChallenge;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccountChallengeService
{
    public function find(Request $request){
        return AccountChallenge::join('accounts','id','=','account_challenges.account_id')
            ->where('account_challenges.challenge_id',$request->input('id'))->get(['account_challenges.*','accounts.fullname']);
    }

    public function add($request){
        $points = 100;
        $challengeService = new ChallengeService();
        $challenge = $challengeService->findOne($request);
        if($request->input('answer') != $challenge->linkfile){
            $points = 0;
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
        return $points > 0;
    }
}