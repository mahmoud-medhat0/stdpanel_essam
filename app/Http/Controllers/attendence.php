<?php

namespace App\Http\Controllers;

use App\Http\Requests\absentall;
use App\Http\Requests\attendedit;
use App\Http\Requests\AttendenceSheetStore;
use App\Http\Requests\attendstore;
use App\Http\Requests\attendupdate;
use App\Http\Requests\delatt;
use App\Imports\AttendenceImport;
use App\Models\attend;
use App\Models\AttendRecord;
use App\Models\Branches;
use App\Models\Sec_type;
use App\Models\students;
use App\Rules\ValidBranch;
use App\Rules\ValidSecType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class attendence extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function new()
    {
        $secs = Sec_type::all();
        return view('attendence/add')->with('secs', $secs);
    }
    public function new_sec($id)
    {
        $secs = ['1', '2', '3'];
        if (!in_array($id, $secs)) {
            abort(404);
        }
        $studentsid = students::where('verified', '1')->where('sec_type_id', $id)->get();
        $branches = Branches::all();
        session()->flash('sec', $id);
        return view('attendence.add_attend')->with('studentsid', $studentsid)->with('branches', $branches);
    }
    public function storeattend(attendstore $req)
    {
        $rs = $req->except('_token', 'sec', 'date', 'branche');
        $validate = array();
        $ids = array();
        foreach ($rs as $key => $value) {
            $d = explode("_", $key);
            switch ($d[0]) {
                case 'id':
                    $validate[$key] = 'required|exists:students,id';
                    if (!in_array($d[1], $ids)) {
                        array_push($ids, $d[1]);
                    }
                    break;
                case 'attend':
                    $validate[$key] = 'required|in:0,1,2';
                    break;
                case 'payed':
                    $validate[$key] = 'required|max:20';
                    break;
                case 'hw':
                    $validate[$key] = 'required|in:0,1';
                    break;
            }
        }
        $req->validate($validate);
        $money = 0;
        foreach ($rs as $key => $value) {
            $d = explode("_", $key);
            if ($d[0] == 'payed') {
                if ($value == "*" || $value == "-") {
                } else {
                    $money += $value;
                }
            }
        }
        AttendRecord::create([
            'date' => $req['date'],
            'money' => $money,
            'Branch_id' => $req['branche'],
            'sec_id' => $req['sec']
        ]);
        $attendrecord = AttendRecord::latest('created_at')->get()[0]->id;
        foreach ($ids as $key => $value) {
            attend::create([
                'std_id' => $value,
                'date' => $req['date'],
                'attendence' => $req['attend_' . $value],
                'hw' => $req['hw_' . $value],
                'payed' => $req['payed_' . $value],
                'reset' => $req['reset_' . $value],
                'branch_id' => $req['branche'],
                'sec_type_id' => $req['sec'],
                'attend_record' => $attendrecord
            ]);
        }
        return redirect()->back()->with('success', 'Attend Record Has Been Added Successful');
    }
    public function attendlist()
    {
        $secs = Sec_type::all();
        return view('attendence/index')->with('secs', $secs);
    }
    public function attendlist_sec($id)
    {
        $secs = ['1', '2', '3'];
        if (!in_array($id, $secs)) {
            abort(404);
        }
        $attendes = AttendRecord::where('sec_id', $id)->select('attend_records.created_at', 'attend_records.id', 'attend_records.money', 'attend_records.date')->join('branches', 'branches.id', 'attend_records.Branch_id')->selectRaw('branches.name')->selectRaw('branches.id As Branchid')->get();
        return view('attendence.index_attend')->with('attendes', $attendes);
    }
    public function attenddelete($id)
    {
        attend::where('attend_record', $id)->delete();
        AttendRecord::where('id', $id)->delete();
        return redirect()->back()->with('success', 'The Attend Record Deleted Successfully');
    }
    public function readattend($id)
    {
        session()->flash('idrecord', $id);
        $students = attend::where('attend_record', $id)->selectRaw('attendence.hw')->selectRaw('attendence.date')->selectRaw('attendence.std_id')->selectRaw('attendence.attendence')->selectRaw('attendence.payed')->selectRaw('attendence.reset')->join('students', 'attendence.std_id', '=', 'students.id')->selectRaw('students.name')->get();
        return view('attendence/edit')->with('students', $students)->with('date', $students[0]->date);
    }
    public function attendupdate(attendupdate $req)
    {
        $id = session()->get('idrecord');
        $rs = $req->except('_token', 'sec', 'date', '_method');
        $validate = array();
        $ids = array();
        foreach ($rs as $key => $value) {
            $d = explode("_", $key);
            switch ($d[0]) {
                case 'id':
                    $validate[$key] = 'required|exists:students,id';
                    if (!in_array($d[1], $ids)) {
                        array_push($ids, $d[1]);
                    }
                    break;
                case 'attend':
                    $validate[$key] = 'required|in:0,1,2';
                    break;
                case 'payed':
                    $validate[$key] = 'required|max:20';
                    break;
                case 'hw':
                    $validate[$key] = 'required|in:0,1';
                    break;
            }
        }
        $req->validate($validate);
        $money = 0;
        foreach ($rs as $key => $value) {
            $d = explode("_", $key);
            if ($d[0] == 'payed') {
                if ($value == "*" || $value == "-") {
                } else {
                    $money += $value;
                }
            }
        }
        AttendRecord::where('id', $id)->update([
            'money' => $money,
        ]);
        foreach ($ids as $key => $value) {
            attend::where('std_id', $value)->where('attend_record', $id)->update([
                'attendence' => $req['attend_' . $value],
                'hw' => $req['hw_' . $value],
                'payed' => $req['payed_' . $value],
                'reset' => $req['reset_' . $value],
            ]);
        }
        return redirect()->back()->with('success', 'Attend Record Has Been updated Successful');
    }
    public function absent_all(absentall $req)
    {
        $id = session()->get('idrecord');
        attend::where('attend_record',$id)->update([
            'attendence'=>'2'
        ]);
        return redirect()->route('attendlist')->with('success', 'absent set for all successfull');
    }
    public function attend_excel()
    {
        $secs = Sec_type::all();
        $branches = Branches::all();
        return view('attendence.add_excel')->with('secs',$secs)->with('branches',$branches);
    }
    public function attend_stamp()
    {
        return response()->download(public_path('stamps/attendence_stamp.xlsx'), 'attend_stamp.xlsx');
    }
    public function store_excel(AttendenceSheetStore $request)
    {
        AttendRecord::create([
            'date'=>$request['date'],
            'Branch_id'=>$request['branch'],
            'sec_id'=>$request['sec']
        ]);
        $idrecord = AttendRecord::latest('created_at')->get()[0]->id;
        session()->flash('idrecord',$idrecord);
        Excel::import(new AttendenceImport,request()->file('sheet'));
        $money = attend::where('attend_record',$idrecord)->sum('payed');
        AttendRecord::where('id',$idrecord)->update([
            'money'=>$money
        ]);
        return redirect()->back()->with('success','Attend Has Been Recorded Success');
    }
}
