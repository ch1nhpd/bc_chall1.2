<?php

namespace App\Http\Controllers\Teachers;

use App\Http\Controllers\Controller;
use App\Http\Service\Teacher\AccountAssService;
use App\Http\Service\Teacher\AssignmentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class AssignmentController extends Controller
{
    protected $assignmentService;
    protected $accountAssService;

    public function __construct(AssignmentService $assignmentService, AccountAssService $accountAssService)
    {
        $this->assignmentService = $assignmentService;
        $this->accountAssService = $accountAssService;
    }

    public function index()
    {
        return view('teacher.assignments', [
            'title' => 'Assignments',
            'assignments' => $this->assignmentService->findAll(),
            'role' => Auth::user()->role
        ]);
    }

    public function add()
    {
        return view('teacher.addAssignment', [
            'title' => 'Add Assignment',
        ]);
    }

    public function addProcess(Request $request)
    {
        if (!Gate::allows('role-T')) {
            abort(403);
        }
        $this->assignmentService->add($request);
        return redirect()->route('assignments');
    }

    public function edit(Request $request)
    {
        if (!Gate::allows('role-T')) {
            abort(403);
        }
        return view('teacher.editAssignment', [
            'title' => 'Update  Assignments',
            'assignment' => $this->assignmentService->findOne($request),
        ]);
    }

    public function editProcess(Request $request)
    {
        if (!Gate::allows('role-T')) {
            abort(403);
        }
        $this->assignmentService->update($request);
        return redirect()->route('assignments');
    }

    public function getOne(Request $request)
    {
        if (!Gate::allows('role-T')) {
            abort(403);
        }
        return view('teacher.assignment', [
            'title' => 'Details  Assignment',
            'assignment' => $this->assignmentService->findOne($request),
            'submitedList' => $this->accountAssService->find($request),
        ]);
    }

    public function submit(Request $request){
        return view('student.submitAssignment', [
            'title' => 'Submit  Assignment',
            'assignment' => $this->assignmentService->findOne($request),
            'fileSubmited' => $this->accountAssService->findSubmited($request),
        ]);
    }

    public function submit_a(Request $request){
        $this->accountAssService->add($request);
        return redirect()->back();
    }



    public function delete(Request $request)
    {
        if (!Gate::allows('role-T')) {
            abort(403);
        }
        $this->assignmentService->destroy($request);
        return redirect()->back();
    }
}
