<?php

namespace App\Http\Controllers;

use App\Http\Requests\delstd;
use App\Http\Requests\editstd;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\studentstoreRequest;
use App\Http\Requests\studentsupdateRequest;
use App\Imports\StudentdImport;
use App\Models\Sec_type;
use App\Models\students;
use App\Rules\ValidSecType;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rules\File;
use Maatwebsite\Excel\Facades\Excel;

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
        $secs = Sec_type::all();
        return view('student/index')->with('secs',$secs);
    }
    public function read_sec($id)
    {
        $secs = ['1','2','3'];
        if (!in_array($id,$secs)) {
            abort(404);
        }
        $students = students::where('sec_type_id',$id)->get();
        return view('student.index_students')->with('students',$students);
    }
    public function add(){
        $secs = Sec_type::all();
        return view('student.add')->with('secs',$secs);
    }
    public function store(studentstoreRequest $request){
            $validate = [
                'name'=>['required','max:255'],
                'username'=>['required','max:255','unique:students,username'],
                'phone'=>['nullable','regex:/^01[0-2,5]\d{8}$/','unique:students,phone'],
                'p_phone'=>['nullable','regex:/^01[0-2,5]\d{8}$/'],
                'verified'=>['required','in:0,1'],
                'password' => ['required','min:8', 'confirmed'],
                'gender'=>['required','in:f,m'],
                'sec'=>['required',new ValidSecType]
            ];
            $request->validate($validate);
            students::create([
                'name' => $request['name'],
                'username'=>$request['username'],
                'phone' => $request['phone'],
                'p_phone' => $request['p_phone'],
                'verified' => $request['verified'],
                'sec_type_id'=>$request['sec'],
                'gender'=>$request['gender'],
                'password' => Hash::make($request['password'])
            ]);
        return redirect()->back()->with('success','Student Added Successfully');
    }
    public function edit($id){
        $student = students::where('id',$id)->get()[0];
        $secs = Sec_type::all();
        return view('student.edit_student')->with('student',$student)->with('secs',$secs);
    }
    public function update (studentsupdateRequest $request){
        $student = students::where('id',$request['id'])->get()[0];
        if ($student->username != $request['username']) {
            $validate['username'] =['required','max:255','unique:students,username'];
        }else {
            $validate['username']=['required','max:255','exists:students,username'];
        }
        if($student->phone != $request['phone']){
            $validate['phone'] =['nullable','regex:/^01[0-2,5]\d{8}$/','unique:students,phone'];
        }else {
            $validate['phone'] =['nullable','regex:/^01[0-2,5]\d{8}$/','exists:students,phone'];
        }
        $validate = [
            'name'=>['required','max:255'],
            'p_phone'=>['nullable','regex:/^01[0-2,5]\d{8}$/'],
            'verified'=>['required','in:0,1'],
            'gender'=>['required','in:f,m'],
            'sec'=>['required',new ValidSecType]
        ];
        $request->validate($validate);
        $student = students::where('id',$request['id']);
        $student = DB::table('students')->where('id','=',$request['id']);
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
                    'gender'=>$request['gender'],
                    'sec_type_id'=>$request['sec'],
                    'p_phone' => $request['p_phone'],
                    'verified' => $request['verified'],
                ]
            );
            if($request['password']!=null){
                $validate1 = array();
                $validate1['password'] = ['password' => ['required','string', 'min:8', 'confirmed']];
                $student->update(
                    [
                        'password' => Hash::make($request['password']),
                    ]
                    );
            }
            return redirect()->route('read',$request->sec)->with('success','Student '.$request['id'].' Data Updated Successfully');
    }
    public function delete(Request $request){
        students::where('id',$request['id'])->delete();
        return redirect()->back()->with('success','Student Data Deleted Successfully');
    }
    public function std_excel()
    {
        $secs = Sec_type::all();
        return view('student.add_excel')->with('secs',$secs);
    }
    public function std_stamp()
    {
        return response()->download(public_path('stamps/students_stamp.xlsx'), 'students_stamp.xlsx');
    }
    public function store_excel()
    {
        $validate=[
            'sec'=>['required',new ValidSecType],
            'sheet' => ['required', File::types(['xls', 'xlsx'])]
        ];
        request()->validate($validate);
        $importer = new StudentdImport;
        $importer->import(request()->file('sheet'));
        if ($importer->failures()->isNotEmpty()) {
            return redirect()->back()->withFailures($importer->failures());
        }
        return redirect()->back()->with('success','Students added successfully');
    }
}
