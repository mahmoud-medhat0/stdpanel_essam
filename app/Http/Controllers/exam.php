<?php

namespace App\Http\Controllers;

use App\Http\Requests\examedit;
use App\Http\Requests\examstore;
use App\Http\Requests\examupdate;
use App\Models\exams;
use App\Models\examupdate as ModelsExamupdate;
use Illuminate\Http\Request;
use App\Models\students;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;

class exam extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        return view('exam/index');
    }
    public function add()
    {
        $studentsid = DB::table('students')->select('id', 'name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        // $studentsname = DB::table('students')->select('name')->where('verified','=',1)->get();
        return view('exam/add', compact('studentsid'), compact('count'));
    }
    public function storeexm(examstore $req)
    {
        $studentsid = DB::table('students')->select('id', 'name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        $r = array_keys($req->except('_token'));
        $r1 = $req->input();
        $degrees = array();
        $id = array();
        $loop = array();
        for ($i = 0; $i < count($r); $i++) {
            $a = explode("_", strval($r[$i]));
            if ($a[0] == "id") {
                array_push($id, $r[$i]);
                array_push($loop,$a[1]);
            }
            if ($a[0] == "degree") {
                array_push($degrees, $r[$i]);
            }
        }
        $validate = array();
        foreach ($id as $idc) {
            $validate[$idc] = 'required|exists:students,id';
        }
        foreach ($degrees as $degree) {
            $validate[$degree] = 'required';
        }
        $data1 = $req->validate($validate);
        foreach ($loop as $lp) {
            $ss=DB::table('exams')->select('std_id', 'date')->where('date', '=', $req['date'])->where('std_id', '=', $req['id_'.strval($lp)])->get();
                if($ss->count()>0){
                    return redirect()->back()->with('success1', 'Exam Already Recorded');
                }
            if (isset($req['degree_'.strval($lp)])) {
                DB::table('exams')->insert([
                    'std_id' => $req['id_'.strval($lp)],
                    'date' => $req['date'],
                    'degree' => $req['degree_'.strval($lp)]
                ]);
            }
        }
        return redirect()->back()->with('success', 'Exam Record ('.$req['date'].') Has Been Added Successful');
        //view('exam/add', compact('success'),compact('studentsid'))->with('success','Exam Record Has Been Added Successful');
    }
    public function examlist()
    {
        $dates = DB::table('exams')->select('date')->groupBy('date')->get();
        $count = $dates->count();
        return view('exam/index', compact('dates'));
    }
    public function delete($date)
    {
        $del = DB::table('exams')->select('*')->where('date','=',$date);
        $del->delete();
        return redirect()->back()->with('success','The Exam Record ('.$date.') Deleted Successfully');
    }
    public function readcexm(examedit $request)
    {   
        $date = $request->except('_token')['date'];
        $studentsid = DB::table('exams')->selectRaw('exams.std_id')->selectRaw('exams.degree')->join('students','exams.std_id','=','students.id')->selectRaw('students.name')->where('exams.date', '=', $date)->get();        
        return view('exam/edit',compact('studentsid'),compact('date'));
    }
    public function examupdate(examupdate $req )
    {   
        $studentsid = DB::table('students')->select('id', 'name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        $r = array_keys($req->except('_token'));
        $degrees = array();
        $id = array();
        $loop = array();
        for ($i = 0; $i < count($r); $i++) {
            $a = explode("_", strval($r[$i]));
            if ($a[0] == "id") {
                array_push($id, $r[$i]);
                array_push($loop,$a[1]);
            }
            if ($a[0] == "degree") {
                array_push($degrees, $r[$i]);
            }
        }
        foreach ($loop as $lp) {
            $idrecord = DB::table('exams')->select('id')->where('std_id', '=', $req['id_'.strval($lp)])->where('date','=', $req['date'])->get();
            $idrecord=$idrecord['0']->id;
            $update = exams::find($idrecord);
            $update->update(['degree' => $req['degree_'.strval($lp)]]);
        }
        return redirect()->route('lstexm')->with('success','The Exam Record ('.$req['date'].') updated Successfully')->withInput();
    }
}
