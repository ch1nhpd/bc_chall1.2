<?php

namespace App\Http\Service\Teacher;

use App\Models\Message;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class MessageService
{
    public function getMessage($request)
    {
        return Message::where([
            ['sender_id', Auth::user()->id],
            ['receiver_id', $request->input('id')]
        ])->get();
    }

    public function getAllReceived()
    {
        return Message::join('accounts', 'accounts.id', '=', 'messages.sender_id')
            ->where('messages.receiver_id', Auth::user()->id)
            ->get(['messages.*', 'accounts.fullname']);
    }

    public function add($request)
    {
        try {
            Message::create([
                'sender_id' => Auth::user()->id,
                'receiver_id' => (int)$request->input('id'),
                'content' => (string)$request->input('content'),
            ]);

            Session::flash('success', 'Sent!');
        } catch (Exception $e) {
            // Session::flash('error',$e->getMessage());
            Session::flash('error', 'Cannot send message!');
        }
    }

    public function destroy($request)
    {
        try{
            $id = $request->input('id');
            Message::where('id', $id)->delete();
            Session::flash('success', 'Deleted success!');
        }catch(Exception $ex){
            Session::flash('error', 'Cannot delete!');
        }
    }

    public function update($request){
        try {
            Message::where('id',$request->input('id'))->update([
                'content' => (string)$request->input('content'),
            ]);
            Session::flash('success', 'Update message successfully!');
        } catch (Exception $ex) {
            Session::flash('error', 'Cannot edit message!');
        }
    }
}
