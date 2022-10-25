<?php

namespace App\Http\Controllers;

use App\Http\Requests\examedit;
use App\Http\Requests\examstore;
use App\Http\Requests\examupdate;
use App\Http\Requests\exmdel;
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
        return view('exam/add');
    }
    public function add_m()
    {
        $studentsid = DB::table('students_m')->select('id', 'name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        return view('exam/add_m', compact('studentsid'), compact('count'));
    }
    public function add_f()
    {
        $studentsid = DB::table('students_f')->select('id', 'name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        return view('exam/add_f', compact('studentsid'), compact('count'));
    }
    public function storeexm(examstore $req)
    {
        if ($req['gender'] =='m'){
            $studentsid = DB::table('students_m')->select('id', 'name')->where('verified', '=', 1)->get();
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
                $validate[$idc] = 'required|exists:students_m,id';
            }
            foreach ($degrees as $degree) {
                $validate[$degree] = 'required';
            }
            $data1 = $req->validate($validate);
            foreach ($loop as $lp) {
                $ss=DB::table('exams_m')->select('std_id', 'date')->where('date', '=', $req['date'])->where('std_id', '=', $req['id_'.strval($lp)])->get();
                    if($ss->count()>0){
                        return redirect()->back()->with('success1', 'Exam Already Recorded');
                    }
                if (isset($req['degree_'.strval($lp)])) {
                    if($req['degree_'.strval($lp)] == null){
                        $deg = '*';
                    }else{
                        $deg=$req['degree_'.strval($lp)];
                    }
                    DB::table('exams_m')->insert([
                        'std_id' => $req['id_'.strval($lp)],
                        'date' => $req['date'],
                        'degree' => $deg
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Exam Record ('.$req['date'].') Has Been Added Successful');
    
        }
        if ($req['gender'] =='f'){
            $studentsid = DB::table('students_f')->select('id', 'name')->where('verified', '=', 1)->get();
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
                $validate[$idc] = 'required|exists:students_f,id';
            }
            foreach ($degrees as $degree) {
                $validate[$degree] = 'required';
            }
            $data1 = $req->validate($validate);
            foreach ($loop as $lp) {
                $ss=DB::table('exams_f')->select('std_id', 'date')->where('date', '=', $req['date'])->where('std_id', '=', $req['id_'.strval($lp)])->get();
                    if($ss->count()>0){
                        return redirect()->back()->with('success1', 'Exam Already Recorded');
                    }
                if (isset($req['degree_'.strval($lp)])) {
                    if($req['degree_'.strval($lp)] == null){
                        $deg = '*';
                    }else{
                        $deg=$req['degree_'.strval($lp)];
                    }
                    DB::table('exams_f')->insert([
                        'std_id' => $req['id_'.strval($lp)],
                        'date' => $req['date'],
                        'degree' => $deg
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Exam Record ('.$req['date'].') Has Been Added Successful');
    
        }

    }
    public function examlist()
    {
        return view('exam/index');
    }
    public function lst_exm_f()
    {
        $dates = DB::table('exams_f')->select('date')->groupBy('date')->get();
        $count = $dates->count();
        return view('exam/index_f', compact('dates'));
    }
    public function lst_exm_m()
    {
        $dates = DB::table('exams_m')->select('date')->groupBy('date')->get();
        $count = $dates->count();
        return view('exam/index_m', compact('dates'));
    }
    public function delete(exmdel $req)
    {
        if ($req['gender'] == 'm'){
            $del = DB::table('exams_m')->select('*')->where('date','=',$req['date']);
            $del->delete();
            return redirect()->back()->with('success','The Exam Record ('.$req['date'].') Deleted Successfully');
        }
        if ($req['gender'] == 'f'){
            $del = DB::table('exams_f')->select('*')->where('date','=',$req['date']);
            $del->delete();
            return redirect()->back()->with('success','The Exam Record ('.$req['date'].') Deleted Successfully');
        }
    }
    public function readcexm(examedit $request)
    {   
        if ($request['gender'] == 'm'){
            $date = $request->except('_token')['date'];
            $studentsid = DB::table('exams_m')->selectRaw('exams_m.std_id')->selectRaw('exams_m.degree')->join('students_m','exams_m.std_id','=','students_m.id')->selectRaw('students_m.name')->where('exams_m.date', '=', $date)->get();        
            return view('exam/edit_m',compact('studentsid'),compact('date'));
        }
        if ($request['gender'] == 'f'){
            $date = $request->except('_token')['date'];
            $studentsid = DB::table('exams_f')->selectRaw('exams_f.std_id')->selectRaw('exams_f.degree')->join('students_f','exams_f.std_id','=','students_f.id')->selectRaw('students_f.name')->where('exams_f.date', '=', $date)->get();        
            return view('exam/edit_f',compact('studentsid'),compact('date'));
        }
    }
    public function examupdate(examupdate $req )
    {   
        if ($req['gender'] == 'm'){
            $studentsid = DB::table('students_m')->select('id', 'name')->where('verified', '=', 1)->get();
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
                $idrecord = DB::table('exams_m')->select('id')->where('std_id', '=', $req['id_'.strval($lp)])->where('date','=', $req['date'])->get();
                $idrecord=$idrecord['0']->id;
                $update = DB::table('exams_m')->select('*')->where('id','=',$idrecord);
                if($req['degree_'.strval($lp)] == null){
                    $deg = '*';
                }else{
                    $deg=$req['degree_'.strval($lp)];
                }
                $update->update(['degree' => $deg]);
            }
            return redirect()->route('lst_exm_m')->with('success','The Exam Record ('.$req['date'].') updated Successfully')->withInput();
        }
        if ($req['gender'] == 'f'){
            $studentsid = DB::table('students_f')->select('id', 'name')->where('verified', '=', 1)->get();
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
                $idrecord = DB::table('exams_f')->select('id')->where('std_id', '=', $req['id_'.strval($lp)])->where('date','=', $req['date'])->get();
                $idrecord=$idrecord['0']->id;
                $update = DB::table('exams_f')->select('*')->where('id','=',$idrecord);
                if($req['degree_'.strval($lp)] == null){
                    $deg = '*';
                }else{
                    $deg=$req['degree_'.strval($lp)];
                }
                $update->update(['degree' => $deg]);
            }
            return redirect()->route('lst_exm_f')->with('success','The Exam Record ('.$req['date'].') updated Successfully')->withInput();
        }
    }
}
