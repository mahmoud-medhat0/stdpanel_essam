<?php

namespace App\Http\Controllers;

use App\Http\Requests\attendedit;
use App\Http\Requests\attendstore;
use App\Http\Requests\attendupdate;
use App\Models\attend;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class attendence extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function new()
    {
        $studentsid = DB::table('students')->selectRaw('students.id')->selectRaw('students.name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        return view('attendence/add', compact('studentsid'), compact('count'));
    }
    public function storeattend(attendstore $req)
    {
        $studentsid = DB::table('students')->selectRaw('students.id')->selectRaw('students.name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        $r = array_keys($req->except('_token'));
        $r1 = $req->input();
        $id = array();
        $attend = array();
        $payed = array();
        $reset = array();
        $exercise = array();
        $loop = array();
        for ($i = 0; $i < count($r); $i++) {
            $a = explode("_", strval($r[$i]));
            if ($a[0] == "id") {
                array_push($id, $r[$i]);
                array_push($loop,$a[1]);
            }
            if ($a[0] == "attend") {
                array_push($attend, $r[$i]);
            }
            if ($a[0] == "payed") {
                array_push($payed, $r[$i]);
            }
            if ($a[0] == "reset") {
                array_push($reset, $r[$i]);
            }

        }
        $validate = array();
        foreach ($attend as $attendq) {
            $validate[$attendq]='required|in:0,1';
        }
        foreach ($id as $idc) {
            $validate[$idc] = 'required|exists:students,id';
        }
        $validate1 = array();
        foreach ($loop as $lp) {
            $validate1['payed_'.strval($lp)] = 'required|max:20';
        }foreach ($loop as $lp) {
            $validate1['attend_'.strval($lp)] = 'required|in:0,1';
        }
        // $req->validate($validate1);
        // $data1 = $req->validate($validate);
        $ss=DB::table('attendence')->select('date')->where('date', '=', $req['date'])->get();
        if($ss->count()>0){
            return redirect()->back()->with('success1', 'Attendence Already Recorded');
        }
        foreach ($loop as $lp) {
            if (isset($req['reset_'.strval($lp)])){
                $reset = $req['reset_'.strval($lp)];
            }
            if($req['reset_'.strval($lp)] == null){
                $reset = '*';
            }
            if ($req['attend_'.strval($lp)] == '0') {
                $validate1 = array();
                $validate1['attend_'.strval($lp)] = 'required|in:0,1';
                $req->validate($validate1);
                DB::table('attendence')->insert([
                    'std_id' => $req['id_'.strval($lp)],
                    'date' => $req['date'],
                    'attendence' => '0',
                    'payed' => '*',
                    'reset' => $reset
                ]);
            }
            if ($req['attend_'.strval($lp)] == '1'){
                $validate1 = array();
                $validate1['payed_'.strval($lp)] = 'required|integer';
                $validate1['attend_'.strval($lp)] = 'required|in:0,1';
                $req->validate($validate1);
                DB::table('attendence')->insert([
                    'std_id' => $req['id_'.strval($lp)],
                    'date' => $req['date'],
                    'attendence' => '1',
                    'payed' => $req['payed_'.strval($lp)],
                    'reset' => $reset
                ]);
            }

        }
        return redirect()->back()->with('success', 'Attend Record Has Been Added Successful');

    }
    public function attendlist()
    {
        $dates = DB::table('attendence')->select('date')->groupBy('date')->get();
        $count = $dates->count();
        return view('attendence/index', compact('dates'));
    }
    public function attenddelete($date)
    {
        $del = DB::table('attendence')->select('*')->where('date','=',$date);
        $del->delete();
        return redirect()->back()->with('success','The Exam Record Deleted Successfully');
    }
    public function readattend(attendedit $request)
    {
        $date = $request->except('_token')['date'];
        $studentsid = DB::table('attendence')->selectRaw('attendence.std_id')->selectRaw('attendence.attendence')->selectRaw('attendence.payed')->selectRaw('attendence.reset')->join('students','attendence.std_id','=','students.id')->selectRaw('students.name')->where('attendence.date', '=', $date)->get();        
        return view('attendence/edit',compact('studentsid'),compact('date'));
    }
    public function attendupdate(attendupdate $req)
    {
        $studentsid = DB::table('students')->selectRaw('students.id')->selectRaw('students.name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        $r = array_keys($req->except('_token'));
        $r1 = $req->input();
        $id = array();
        $attend = array();
        $payed = array();
        $reset = array();
        $loop = array();
        for ($i = 0; $i < count($r); $i++) {
            $a = explode("_", strval($r[$i]));
            if ($a[0] == "id") {
                array_push($id, $r[$i]);
                array_push($loop,$a[1]);
            }
            if ($a[0] == "attend") {
                array_push($attend, $r[$i]);
            }
            if ($a[0] == "payed") {
                array_push($payed, $r[$i]);
            }
        }
        $validate = array();
        foreach ($attend as $attendq) {
            $validate[$attendq]='required|in:0,1';
        }
        foreach ($id as $idc) {
            $validate[$idc] = 'required|exists:students,id';
        }
        $data1 = $req->validate($validate);
        $validate1 = array();
        foreach ($loop as $lp) {
            $validate1['payed_'.strval($lp)] = 'required|max:20';
        }foreach ($loop as $lp) {
            $validate1['attend_'.strval($lp)] = 'required|in:0,1';
        }
        $req->validate($validate1);
        foreach ($loop as $lp) {
            $idrecord = DB::table('attendence')->select('id')->where('std_id', '=', $req['id_'.strval($lp)])->where('date','=', $req['date'])->get();
            $idrecord=$idrecord['0']->id;
            if (isset($req['reset_'.strval($lp)])){
                $reset = $req['reset_'.strval($lp)];
            }
            if($req['reset_'.strval($lp)] == null){
                $reset = '*';
            }
            if (!isset($req['attend_'.strval($lp)]) || $req['attend_'.strval($lp)] == '0') {
                $validate1 = array();
                $validate1['attend_'.strval($lp)] = 'required|in:0,1';
                $req->validate($validate1);
                $update= DB::table('attendence')->where('id','=',$idrecord);
                $update->update([
                    'attendence' => '0',
                    'payed' => '*',
                    'reset' => $reset
                ]);
            }
            if ($req['attend_'.strval($lp)] == '1'){
                $validate1 = array();
                $validate1['payed_'.strval($lp)] = 'required|integer';
                $validate1['attend_'.strval($lp)] = 'required|in:0,1';
                $req->validate($validate1);
                $update= DB::table('attendence')->where('id','=',$idrecord);
                $update->update([
                    'attendence' => '1',
                    'payed' => $req['payed_'.strval($lp)],
                    'reset' => $reset
                ]);         
            }
        }
            return redirect()->route('attendlist')->with('success','The Attendence Record Has Been Updated Successfully');
    }
}