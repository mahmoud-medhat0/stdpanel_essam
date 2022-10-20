<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\exerciseedit;
use App\Http\Requests\exercisestore;
use App\Http\Requests\exerciseupdate;
use App\Models\exercise as ModelsExercise;

class exercise extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function exerciseadd()
    {
        $studentsid = DB::table('students')->select('id', 'name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        // $studentsname = DB::table('students')->select('name')->where('verified','=',1)->get();
        return view('exercise/add', compact('studentsid'), compact('count'));
    }
    public function exercisestore(exercisestore $req)
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
            $ss=DB::table('exercises')->select('std_id', 'date')->where('date', '=', $req['date'])->where('std_id', '=', $req['id_'.strval($lp)])->get();
                if($ss->count()>0){
                    return redirect()->back()->with('success1', 'Exercise Already Recorded');
                }
            if (isset($req['degree_'.strval($lp)])) {
                DB::table('exercises')->insert([
                    'std_id' => $req['id_'.strval($lp)],
                    'date' => $req['date'],
                    'degree' => $req['degree_'.strval($lp)]
                ]);
            }
        }
        return redirect()->back()->with('success', 'Exercise Record('.$req['date'].') Has Been Added Successful');
    }

    public function exerciselist()
    {
        $dates = DB::table('exercises')->select('date')->groupBy('date')->get();
        $count = $dates->count();
        return view('exercise/index', compact('dates'));
    }
    public function readexercise(exerciseedit $request)
    {   
        $date = $request->except('_token')['date'];
        $studentsid = DB::table('exercises')->selectRaw('exercises.std_id')->selectRaw('exercises.degree')->join('students','exercises.std_id','=','students.id')->selectRaw('students.name')->where('exercises.date', '=', $date)->get();        
        return view('exercise/edit',compact('studentsid'),compact('date'));
    }
    public function exerciseupdate(exerciseupdate $req )
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
            $idrecord = DB::table('exercises')->select('id')->where('std_id', '=', $req['id_'.strval($lp)])->where('date','=', $req['date'])->get();
            $idrecord=$idrecord['0']->id;
            $update = ModelsExercise::find($idrecord);
            $update->update(['degree' => $req['degree_'.strval($lp)]]);
        }
        return redirect()->route('exerciselist')->with('success','The Exam Record ('.$req['date'].') updated Successfully')->withInput();
    }
    public function exercisedelete($date)
    {
        $del = DB::table('exercises')->select('*')->where('date','=',$date);
        $del->delete();
        return redirect()->back()->with('success','The Exercise('.strval($date).') Record Deleted Successfully');
    }

}
