<?php

namespace App\Http\Controllers;

use App\Http\Requests\absentall;
use App\Http\Requests\attendedit;
use App\Http\Requests\attendstore;
use App\Http\Requests\attendupdate;
use App\Http\Requests\delatt;
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
        return view('attendence/add');
    }
    public function new_m()
    {
        $studentsid = DB::table('students_m')->selectRaw('students_m.id')->selectRaw('students_m.name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        return view('attendence.add_m', compact('studentsid'), compact('count'));
    }
    public function new_f()
    {
        $studentsid = DB::table('students_f')->selectRaw('students_f.id')->selectRaw('students_f.name')->where('verified', '=', 1)->get();
        $count = $studentsid->count();
        return view('attendence.add_f', compact('studentsid'), compact('count'));
    }
    public function storeattend(attendstore $req)
    {
        if($req['gender'] == 'm'){
            $studentsid = DB::table('students_m')->selectRaw('students_m.id')->selectRaw('students_m.name')->where('verified', '=', 1)->get();
            $count = $studentsid->count();
            $r = array_keys($req->except('_token'));
            $r1 = $req->input();
            $id = array();
            $attend = array();
            $payed = array();
            $reset = array();
            $hw = array();
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
                if ($a[0] == "hw") {
                    array_push($hw, $r[$i]);
                }
            }
            $validate = array();
            foreach ($attend as $attendq) {
                $validate[$attendq]='required|in:0,1';
            }
            foreach ($hw as $hw1) {
                $validate[$hw1]='require d|in:0,1';
            }
            foreach ($id as $idc) {
                $validate[$idc] = 'required|exists:students_m,id';
            }
            $validate1 = array();
            foreach ($loop as $lp) {
                $validate1['payed_'.strval($lp)] = 'required|max:20';
            }foreach ($loop as $lp) {
                $validate1['attend_'.strval($lp)] = 'required|in:0,1';
            }
            $ss=DB::table('attendence_m')->select('date')->where('date', '=', $req['date'])->get();
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
                    DB::table('attendence_m')->insert([
                        'std_id' => $req['id_'.strval($lp)],
                        'date' => $req['date'],
                        'attendence' => '0',
                        'payed' => '*',
                        'reset' => $reset,
                        'hw' => '0'
                    ]);
                }
                if ($req['attend_'.strval($lp)] == '1'){
                    $validate1 = array();
                    $validate1['payed_'.strval($lp)] = 'required|integer';
                    $validate1['attend_'.strval($lp)] = 'required|in:0,1';
                    $validate1['hw_'.strval($lp)] = 'required|in:0,1';
                    $req->validate($validate1);
                    DB::table('attendence_m')->insert([
                        'std_id' => $req['id_'.strval($lp)],
                        'date' => $req['date'],
                        'attendence' => '1',
                        'payed' => $req['payed_'.strval($lp)],
                        'reset' => $reset,
                        'hw' => $req['hw_'.strval($lp)]
                    ]);
                }
    
            }
            return redirect()->back()->with('success', 'Attend Record Has Been Added Successful');
    
    
        }
        if($req['gender'] == 'f'){
            $studentsid = DB::table('students_f')->selectRaw('students_f.id')->selectRaw('students_f.name')->where('verified', '=', 1)->get();
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
                $validate[$idc] = 'required|exists:students_f,id';
            }
            $validate1 = array();
            foreach ($loop as $lp) {
                $validate1['payed_'.strval($lp)] = 'required|max:20';
            }foreach ($loop as $lp) {
                $validate1['attend_'.strval($lp)] = 'required|in:0,1';
            }
            $ss=DB::table('attendence_f')->select('date')->where('date', '=', $req['date'])->get();
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
                    DB::table('attendence_f')->insert([
                        'std_id' => $req['id_'.strval($lp)],
                        'date' => $req['date'],
                        'attendence' => '0',
                        'payed' => '*',
                        'reset' => $reset,
                        'hw' => '0'
                    ]);
                }
                if ($req['attend_'.strval($lp)] == '1'){
                    $validate1 = array();
                    $validate1['payed_'.strval($lp)] = 'required|integer';
                    $validate1['attend_'.strval($lp)] = 'required|in:0,1';
                    $validate1['hw_'.strval($lp)] = 'required';
                    $req->validate($validate1);
                    DB::table('attendence_f')->insert([
                        'std_id' => $req['id_'.strval($lp)],
                        'date' => $req['date'],
                        'attendence' => '1',
                        'payed' => $req['payed_'.strval($lp)],
                        'reset' => $reset,
                        'hw' => $req['hw_'.strval($lp)]
                    ]);
                }
    
            }
            return redirect()->back()->with('success', 'Attend Record Has Been Added Successful');
    
    
        }
    }
    public function attendlist()
    {
        return view('attendence/index');
    }
    public function attendlist_m()
    {
        $dates = DB::table('attendence_m')->select('date')->groupBy('date')->get();
        $count = $dates->count();
        return view('attendence/index_m', compact('dates'));
    }
    public function attendlist_f()
    {
        $dates = DB::table('attendence_f')->select('date')->groupBy('date')->get();
        $count = $dates->count();
        return view('attendence/index_f', compact('dates'));
    }
    public function attenddelete(delatt $req)
    {
        if ($req['gender'] == 'm'){
            $del = DB::table('attendence_m')->select('*')->where('date','=',$req['date']);
            $del->delete();
            return redirect()->back()->with('success','The Attend Record Deleted Successfully');
        }
        if ($req['gender'] == 'f'){
            $del = DB::table('attendence_f')->select('*')->where('date','=',$req['date']);
            $del->delete();
            return redirect()->back()->with('success','The Attend Record Deleted Successfully');
        }
    }
    public function readattend(attendedit $request)
    {
        if ($request['gender'] == 'm'){
            $date = $request->except('_token')['date'];
            $studentsid = DB::table('attendence_m')->selectRaw('attendence_m.std_id')->selectRaw('attendence_m.attendence')->selectRaw('attendence_m.payed')->selectRaw('attendence_m.reset')->join('students_m','attendence_m.std_id','=','students_m.id')->selectRaw('students_m.name')->where('attendence_m.date', '=', $date)->get();        
            return view('attendence/edit_m',compact('studentsid'),compact('date'));
        }
        if ($request['gender'] == 'f'){
            $date = $request->except('_token')['date'];
            $studentsid = DB::table('attendence_f')->selectRaw('attendence_f.std_id')->selectRaw('attendence_f.attendence')->selectRaw('attendence_f.payed')->selectRaw('attendence_f.reset')->join('students_f','attendence_f.std_id','=','students_f.id')->selectRaw('students_f.name')->where('attendence_f.date', '=', $date)->get();        
            return view('attendence/edit_f',compact('studentsid'),compact('date'));
        }
    }
    public function attendupdate(attendupdate $req)
    {
        if ($req['gender'] == 'm'){
            $studentsid = DB::table('students_m')->selectRaw('students_m.id')->selectRaw('students_m.name')->where('verified', '=', 1)->get();
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
                $validate[$idc] = 'required|exists:students_m,id';
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
                $idrecord = DB::table('attendence_m')->select('id')->where('std_id', '=', $req['id_'.strval($lp)])->where('date','=', $req['date'])->get();
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
                    $update= DB::table('attendence_m')->where('id','=',$idrecord);
                    $update->update([
                        'attendence' => '0',
                        'payed' => '*',
                        'reset' => $reset,
                        'hw' => '0'
                    ]);
                }
                if ($req['attend_'.strval($lp)] == '1'){
                    $validate1 = array();
                    $validate1['payed_'.strval($lp)] = 'required|integer';
                    $validate1['attend_'.strval($lp)] = 'required|in:0,1';
                    
                    $req->validate($validate1);
                    $update= DB::table('attendence_m')->where('id','=',$idrecord);
                    $update->update([
                        'attendence' => '1',
                        'payed' => $req['payed_'.strval($lp)],
                        'reset' => $reset,
                        'hw' => $req['hw_'.strval($lp)]
                    ]);         
                }
            }
                return redirect()->route('lst_attend_m')->with('success','The Attendence Record Has Been Updated Successfully');
    
        }
        if ($req['gender'] == 'f'){
            $studentsid = DB::table('students_f')->selectRaw('students_f.id')->selectRaw('students_f.name')->where('verified', '=', 1)->get();
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
                $validate[$idc] = 'required|exists:students_f,id';
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
                $idrecord = DB::table('attendence_f')->select('id')->where('std_id', '=', $req['id_'.strval($lp)])->where('date','=', $req['date'])->get();
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
                    $update= DB::table('attendence_f')->where('id','=',$idrecord);
                    $update->update([
                        'attendence' => '0',
                        'payed' => '*',
                        'reset' => $reset,
                        'hw' => '0'
                    ]);
                }
                if ($req['attend_'.strval($lp)] == '1'){
                    $validate1 = array();
                    $validate1['payed_'.strval($lp)] = 'required|integer';
                    $validate1['attend_'.strval($lp)] = 'required|in:0,1';
                    $req->validate($validate1);
                    $update= DB::table('attendence_f')->where('id','=',$idrecord);
                    $update->update([
                        'attendence' => '1',
                        'payed' => $req['payed_'.strval($lp)],
                        'reset' => $reset,
                        'hw' => $req['hw_'.strval($lp)]
                    ]);         
                }
            }
                return redirect()->route('lst_attend_f')->with('success','The Attendence Record Has Been Updated Successfully');
    
        }
    }
    public function absent_all(absentall $req)
    {
        $update = DB::table('attendence_m')->select('*')->where('date','=',$req['date'])->where('attendence','=','0');
        $update->update([
            'attendence' => '2'
        ]);
        $update = DB::table('attendence_f')->select('*')->where('date','=',$req['date'])->where('attendence','=','0');
        $update->update([
            'attendence' => '2'
        ]);
        return redirect()->route('attendlist')->with('success','absent set for all successfull');
    }
}