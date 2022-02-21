<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Service\Teacher\MessageService;
use Illuminate\Http\Request;

class MessageController extends Controller
{
    //

    protected $messageService;

    public function __construct( MessageService $messageservice)
    {
        $this->messageService = $messageservice;
    }
    public function index(){
        return view('messages',[
            'title'=>'Messages Received',
            'messages'=>$this->messageService->getAllReceived(),
        ]);
    }

    public function sendMessage(Request $request){
        $this->messageService->add($request);
        return redirect()->back();
    }

    public function delete(Request $request){
        $this->messageService->destroy($request);
        return redirect()->back();
    }

    public function update(Request $request){
        $this->messageService->update($request);
        return redirect()->back();
    }
}
