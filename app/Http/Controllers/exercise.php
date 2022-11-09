<?php

namespace App\Http\Controllers;

use App\Http\Requests\delexc;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\exerciseedit;
use App\Http\Requests\exercisestore;
use App\Http\Requests\exerciseupdate;

class exercise extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function exerciseadd()
    {
        return view('exercise/add');
    }
    public function add_exc_m()
    {
        $studentsid = DB::table('students_m')->select('id', 'name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        // $studentsname = DB::table('students')->select('name')->where('verified','=',1)->get();
        return view('exercise/add_m', compact('studentsid'), compact('count'));
    }
    public function add_exc_f()
    {
        $studentsid = DB::table('students_f')->select('id', 'name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        // $studentsname = DB::table('students')->select('name')->where('verified','=',1)->get();
        return view('exercise/add_f', compact('studentsid'), compact('count'));
    }

    public function exercisestore(exercisestore $req)
    {
        if ($req['gender'] == 'm'){
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
            $data1 = $req->validate($validate);
            foreach ($loop as $lp) {
                $ss=DB::table('exercises_m')->select('std_id', 'date')->where('date', '=', $req['date'])->where('std_id', '=', $req['id_'.strval($lp)])->get();
                    if($ss->count()>0){
                        return redirect()->back()->with('success1', 'Exercise Already Recorded');
                    }
                if (isset($req['degree_'.strval($lp)])) {
                    if($req['degree_'.strval($lp)] == null){
                        $deg = '*';
                    }else{
                        $deg=$req['degree_'.strval($lp)];
                    }
                    DB::table('exercises_m')->insert([
                        'std_id' => $req['id_'.strval($lp)],
                        'date' => $req['date'],
                        'degree' => $deg
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Exercise Record('.$req['date'].') Has Been Added Successful');
    
        }
        if ($req['gender'] == 'f'){
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
            $data1 = $req->validate($validate);
            foreach ($loop as $lp) {
                $ss=DB::table('exercises_f')->select('std_id', 'date')->where('date', '=', $req['date'])->where('std_id', '=', $req['id_'.strval($lp)])->get();
                    if($ss->count()>0){
                        return redirect()->back()->with('success1', 'Exercise Already Recorded');
                    }
                if (isset($req['degree_'.strval($lp)])) {
                    if($req['degree_'.strval($lp)] == null){
                        $deg = '*';
                    }else{
                        $deg=$req['degree_'.strval($lp)];
                    }
                    DB::table('exercises_f')->insert([
                        'std_id' => $req['id_'.strval($lp)],
                        'date' => $req['date'],
                        'degree' => $deg
                    ]);
                }
            }
            return redirect()->back()->with('success', 'Exercise Record('.$req['date'].') Has Been Added Successful');
    
        }
    }

    public function exerciselist()
    {
        return view('exercise/index');
    }
    public function lst_exc_m()
    {
        $dates = DB::table('exercises_m')->select('date')->groupBy('date')->get();
        $count = $dates->count();
        return view('exercise/index_m', compact('dates'));
    }
    public function lst_exc_f()
    {
        $dates = DB::table('exercises_f')->select('date')->groupBy('date')->get();
        $count = $dates->count();
        return view('exercise/index_f', compact('dates'));
    }
    public function readexercise(exerciseedit $request)
    {   
        if ($request['gender'] == 'm'){
        $date = $request->except('_token')['date'];
        $studentsid = DB::table('exercises_m')->selectRaw('exercises_m.std_id')->selectRaw('exercises_m.degree')->join('students_m','exercises_m.std_id','=','students_m.id')->selectRaw('students_m.name')->where('exercises_m.date', '=', $date)->get();        
        return view('exercise/edit_m',compact('studentsid'),compact('date'));
        }
        if ($request['gender'] == 'f'){
        $date = $request->except('_token')['date'];
        $studentsid = DB::table('exercises_f')->selectRaw('exercises_f.std_id')->selectRaw('exercises_f.degree')->join('students_f','exercises_f.std_id','=','students_f.id')->selectRaw('students_f.name')->where('exercises_f.date', '=', $date)->get();        
        return view('exercise/edit_f',compact('studentsid'),compact('date'));
        }
    }
    public function exerciseupdate(exerciseupdate $req )
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
                $idrecord = DB::table('exercises_m')->select('id')->where('std_id', '=', $req['id_'.strval($lp)])->where('date','=', $req['date'])->get();
                $idrecord=$idrecord['0']->id;
                $update = DB::table('exercises_m')->select('*')->where('id','=',$idrecord);
                if($req['degree_'.strval($lp)] == null){
                    $deg = '*';
                }else{
                    $deg=$req['degree_'.strval($lp)];
                }
                $update->update(['degree' => $deg]);
            }
            return redirect()->route('lst_exc_m')->with('success','The Exam Record ('.$req['date'].') updated Successfully')->withInput();
    
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
                $idrecord = DB::table('exercises_f')->select('id')->where('std_id', '=', $req['id_'.strval($lp)])->where('date','=', $req['date'])->get();
                $idrecord=$idrecord['0']->id;
                $update = DB::table('exercises_f')->select('*')->where('id','=',$idrecord);
                if($req['degree_'.strval($lp)] == null){
                    $deg = '*';
                }else{
                    $deg=$req['degree_'.strval($lp)];
                }
                $update->update(['degree' => $deg]);
            }
            return redirect()->route('lst_exc_f')->with('success','The Exam Record ('.$req['date'].') updated Successfully')->withInput();
    
        }
    }
    public function exercisedelete(delexc $request)
    {
        if ($request['gender'] == 'm'){
        $del = DB::table('exercises_m')->select('*')->where('date','=',$request['date']);
        $del->delete();
        return redirect()->back()->with('success','The Exercise('.strval($request['date']).') Record Deleted Successfully');
        }
        if ($request['gender'] == 'f'){
            $del = DB::table('exercises_f')->select('*')->where('date','=',$request['date']);
            $del->delete();
            return redirect()->back()->with('success','The Exercise('.strval($request['date']).') Record Deleted Successfully');
        }
    }

}
