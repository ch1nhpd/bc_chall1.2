<?php

namespace App\Http\Service\Teacher;


use App\Models\Assignment;
use DateTime;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AssignmentService
{
    public function findAll()
    {
        return Assignment::all();
    }

    public function findOne($request)
    {
        return Assignment::where('id', $request->input('id'))->get()->first();
    }



    public function add($request)
    {
        try {
            $file = $request->file('file_upload');
            $file->storeAs('uploads', $file->getClientOriginalName()); //storage/app/uploads/filename
            // $file->move('uploads', $file->getClientOriginalName()); //public/uploads
            Assignment::create([
                'description' => (string)$request->input('description'),
                'due' => date("Y-m-d H:i:s", strtotime($request->input('due'))),
                'linkfile' => (string)$file->getClientOriginalName(),
                'created_by' => (int)Auth::user()->id,
            ]);

            Session::flash('success', 'Add Assignment successfully!');
        } catch (Exception $e) {
            // Session::flash('error',$e->getMessage());
            Session::flash('error', 'Cannot create Assignment!');
        }
    }

    public function update($request)
    {
        if (Auth::user()->role === 'T') {
            try {
                if ($request->hasFile('file_upload')) {
                    $file = $request->file('file_upload');
                    $fileName = $file->getClientOriginalName();
                    $file->storeAs('uploads', $fileName);
                    Assignment::where('id', $request->input('id'))->update([
                        'description' => (string)$request->input('description'),
                        'due' => date("Y-m-d H:i:s", strtotime($request->input('due'))),
                        'linkfile' => (string)$fileName,

                    ]);
                    //thieu doan xoa file cu di
                    Session::flash('success', 'Update account successfully!');
                } else {
                    Assignment::where('id', $request->input('id'))->update([
                        'description' => (string)$request->input('description'),
                        'due' => date("Y-m-d H:i:s", strtotime($request->input('due'))),
                    ]);
                    Session::flash('success', 'Update Assignment successfully!');
                }
            } catch (Exception $ex) {
                Session::flash('error', 'Cannot Assignment account!');
            }
        }
    }

    public function destroy($request)
    {
        try {
            $id = $request->input('id');
            Assignment::where('id', $id)->delete();
            Session::flash('success', 'Deleted Assignment!');
        } catch (Exception $ex) {
            Session::flash('error', 'Cannot delete Assignment!');
        }
    }
}
