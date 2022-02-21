<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Account\AddFormRequest;
use App\Http\Requests\Account\EditFormRequest;
use App\Http\Requests\UpdateFormRequest;
use App\Http\Service\Teacher\AccountService;
use App\Http\Service\Teacher\MessageService;
use App\Models\Account;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class UserController extends Controller
{

    protected $accountService;
    protected $messageService;

    public function __construct(AccountService $accountService, MessageService $messageservice)
    {
        $this->accountService = $accountService;
        $this->messageService = $messageservice;
    }

    //
    public function index()
    {
        return view('teacher.users', [
            'title' => 'Users',
            'users' => $this->accountService->getusers(),
            'role' => Auth::user()->role
        ]);
    }

    public function add()
    {
        return view('teacher.adduser', [
            'title' => 'Add User'
        ]);
    }

    public function addProcess(AddFormRequest $request)
    {
        if (!Gate::allows('role-T')) {
            abort(403);
        }
        $result = $this->accountService->add($request);
        return redirect()->route('users_teacher');
    }

    public function edit(Request $request)
    {
        if (!Gate::allows('role-T')) {
            abort(403);
        }
        return view('teacher.edituser', [
            'title' => 'Edit User',
            'user' => $this->accountService->getuser($request)
        ]);
    }

    public function editProcess(AddFormRequest $request)
    {
        if (Gate::allows('role-T') or Gate::allows('update-profile',Auth::user()->id)) {
            $result = $this->accountService->update($request);
            return redirect()->route('users_teacher');
        } else {
            abort(403);
        }
    }

    public function delete(Request $request)
    {
        if (!Gate::allows('role-T')) {
            abort(403);
        }
        $result = $this->accountService->destroy($request);
        return redirect()->back();
    }

    public function showinfo(Request $request)
    {
        return view('profile', [
            'title' => 'Profile',
            'user' => $this->accountService->getuser($request),
            'messages' => $this->messageService->getMessage($request)
        ]);
    }

    public function profile()
    {
        return view('teacher.edituser', [
            'title' => 'Update My Profile',
            'user' => $this->accountService->getCurrentUser()
        ]);
    }

}
