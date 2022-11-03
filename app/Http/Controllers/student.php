<?php

namespace App\Http\Controllers;

use App\Http\Requests\delstd;
use App\Http\Requests\editstd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\studentstoreRequest;
use App\Http\Requests\studentsupdateRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\Unique;

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
        return view('student/index2_students');
    }
    public function read_m()
    {
        $students = DB::table('students_m')->select('*')->get();
        return view('student.index_students_m',compact('students'));
    }
    public function read_f()
    {
        $students = DB::table('students_f')->select('*')->get();
        return view('student.index_students_f',compact('students')); 
    }
    public function add(){
        return view('student/add2_student');
    }
    public function store(studentstoreRequest $request){
        if ($request['gender'] =='m' ){
            $validate = [
                'name'=>['required','max:255'],
                'username'=>['required','max:255','unique:students_m,username'],
                'phone'=>['regex:/^01[0-2,5]\d{8}$/','unique:students_m,phone'],
                'p_phone'=>['required','regex:/^01[0-2,5]\d{8}$/'],
                'verified'=>['required','in:0,1'],
                'password' => ['required','min:8', 'confirmed']
            ];
            $request->validate($validate);
            if($request['phone'] == null){
                $phone = '*';
            }else{
                $phone=$request['phone'];
            }
            DB::table('students_m')->insert([
                'name' => $request['name'],
                'username'=>$request['username'],
                'phone' => $phone,
                'p_phone' => $request['p_phone'],
                'verified' => $request['verified'],
                'password' => Hash::make($request['password'])
            ]);
        }
        if ($request['gender'] =='f' ){
            $validate = [
                'name'=>['required','max:255'],
                'username'=>['required','max:255','unique:students_f,username'],
                'phone'=>['regex:/^01[0-2,5]\d{8}$/','unique:students_f,phone'],
                'p_phone'=>['required','regex:/^01[0-2,5]\d{8}$/'],
                'verified'=>['required','in:0,1'],
                'password' => ['required','min:8', 'confirmed']
            ];
            $request->validate($validate);
            if($request['phone'] == null){
                $phone = '*';
            }else{
                $phone=$request['phone'];
            }
            DB::table('students_f')->insert([
                'name' => $request['name'],
                'username'=>$request['username'],
                'phone' => $phone,
                'p_phone' => $request['p_phone'],
                'verified' => $request['verified'],
                'password' => Hash::make($request['password'])
            ]);
        }
        return redirect()->back()->with('success','Student Added Successfully');
    }
    public function edit(editstd $request){
        if ($request['gender'] =='f' ){
            $student = DB::table('students_f')->select('*')->where('id','=',$request['id'])->get()[0];
            return view('student.edit_student_f',compact('student'));
        }
        if ($request['gender'] =='m' ){
            $student = DB::table('students_m')->select('*')->where('id','=',$request['id'])->get()[0];
            return view('student.edit_student_m',compact('student'));
        }

    }
    public function update (studentsupdateRequest $request){
        if ($request['gender'] == 'm'){
            $student = DB::table('students_m')->where('id','=',$request['id']);
            if($request['phone'] == null){
                $phone = '*';
            }else{
                $phone=$request['phone'];
            }
            $student->update(
                [
                    'name' => $request['name'],
                    'username'=>$request['username'],
                    'phone' => $phone,
                    'p_phone' => $request['p_phone'],
                    'verified' => $request['verified'],
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
            $students = DB::table('students_m')->select('*')->get();
            return view('student.index_students_m',compact('students'))->with('success','Student Male '.$request['id'].' Data Updated Successfully');
        }
        if ($request['gender'] == 'f'){
            $student = DB::table('students_f')->where('id','=',$request['id']);
            if($request['phone'] == null){
                $phone = '*';
            }else{
                $phone=$request['phone'];
            }
            $student->update(
                [
                    'name' => $request['name'],
                    'username'=>$request['username'],
                    'phone' => $phone,
                    'p_phone' => $request['p_phone'],
                    'verified' => $request['verified'],
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
            $students = DB::table('students_f')->select('*')->get();
            return view('student.index_students_f',compact('students'))->with('success','Student Female '.$request['id'].' Data Updated Successfully');
        }

    }
    public function delete(delstd $request){
        if ($request['gender'] == 'm'){
            $student = DB::table('students_m')->where('id','=',$request['id']);
            $student->delete();
        }
        if ($request['gender'] == 'f'){
            $student = DB::table('students_f')->where('id','=',$request['id']);
            $student->delete();
        }
        return redirect()->back()->with('success','Student Data Deleted Successfully');
    }
}
