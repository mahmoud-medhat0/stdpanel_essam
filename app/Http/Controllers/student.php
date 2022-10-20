<?php

namespace App\Http\Controllers;

use App\Models\students;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\studentstoreRequest;
use App\Http\Requests\studentsupdateRequest;
use Illuminate\Support\Facades\DB;

class student extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(){
        return view('student/index');
    }
    public function read (){
        $students = students::all();
        return view('student/index2_students',compact('students'));
    }
    public function add(){
        return view('student/add2_student');
    }
    public function store(studentstoreRequest $request){
        $data= $request->except('_token');
        students::create([
            'name' => $request['name'],
            'phone' => $request['phone'],
            'p_phone' => $request['p_phone'],
            'verified' => $request['verified'],
            'gender' => $request['gender'],
            'password' => Hash::make($request['password'])
        ]);
        // return view('student.index',compact('request'));
        return redirect()->back()->with('success','Student Added Successfully');
    }
    public function edit($id){
        $student = students::find($id);
        return view('student/edit2_student',compact('student'));
    }
    public function update (studentsupdateRequest $request,$id){
        $student = DB::table('students')->where('id','=',$id);
        $student->update(
            [
                'name' => $request['name'],
                'phone' => $request['phone'],
                'p_phone' => $request['p_phone'],
                'verified' => $request['verified'],
                'gender' => $request['gender']
            ]
        );
        if(isset($request['password'])){
            $validate1 = array();
            $validate1['password'] = ['password' => ['required','string', 'min:8', 'confirmed']];
            $student->update(
                [
                    'password' => Hash::make($request['password']),
                ]
                );
        }

        return redirect()->back()->with('success','Student Data Updated Successfully');
    }
    public function delete($id){
        $student = students::find($id);
        $student->delete();
        return redirect()->back()->with('success','Student Data Deleted Successfully');
    }
}
