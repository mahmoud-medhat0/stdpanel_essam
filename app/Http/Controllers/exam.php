<?php

namespace App\Http\Controllers;

use App\Models\exams;
use App\Models\Branches;
use App\Models\Sec_type;
use App\Models\students;
use App\Models\ExamRecords;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Http\Requests\exmdel;
use App\Http\Requests\examedit;
use App\Http\Requests\examstore;
use App\Http\Requests\examupdate;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ExamsStoreExcel;
use App\Imports\ExamsImport;
use App\Models\examupdate as ModelsExamupdate;

class exam extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $secs = Sec_type::all();
        return view('exam/index')->with('secs', $secs);
    }
    public function list_exam($id)
    {
        $secs = ['1', '2', '3'];
        if (!in_array($id, $secs)) {
            abort(404);
        }
        $exams = ExamRecords::where('sec_id', $id)->select('exam_records.created_at', 'exam_records.id', 'exam_records.money', 'exam_records.date')->join('branches', 'branches.id', 'exam_records.Branch_id')->selectRaw('branches.name')->get();
        return view('exam.index_exams')->with('exams', $exams);
    }
    public function add()
    {
        $secs = Sec_type::all();
        return view('exam/add')->with('secs', $secs);
    }
    public function add_exm($id)
    {
        $secs = ['1', '2', '3'];
        if (!in_array($id, $secs)) {
            abort(404);
        }
        session()->flash('sec', $id);
        $branches = Branches::all();
        $students = students::where('sec_type_id', $id)->where('verified', '=', 1)->get();
        return view('exam/add_exam')->with('branches', $branches)->with('students', $students);
    }
    public function storeexm(examstore $req)
    {
        $sec = session()->get('sec');
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
                case 'degree':
                    $validate[$key] = 'required|int';
                    break;
                case 'payed':
                    $validate[$key] = 'required|max:20';
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
        ExamRecords::create([
            'date' => $req['date'],
            'money' => $money,
            'Branch_id' => $req['branche'],
            'sec_id' => $sec
        ]);
        $ExamRecord = ExamRecords::latest('created_at')->get()[0]->id;
        foreach ($ids as $key => $value) {
            exams::create([
                'std_id' => $value,
                'date' => $req['date'],
                'payed' => $req['payed_' . $value],
                'degree' => $req['degree_' . $value],
                'branch_id' => $req['branche'],
                'sec_type_id' => $sec,
                'exam_record' => $ExamRecord
            ]);
        }
        return redirect()->route('lstexm')->with('success', 'Exam Record (' . $ExamRecord . ') Has Been Added Successful');
    }
    public function delete($id)
    {
        exams::where('exam_record', $id)->delete();
        ExamRecords::where('id', $id)->delete();
        return redirect()->back()->with('success', 'The Exam Record (' . $id . ') Deleted Successfully');
    }
    public function readcexm($id)
    {
        session()->flash('idrecord', $id);
        $students = exams::where('exam_record', $id)->select('exams.id', 'exams.std_id', 'exams.degree', 'exams.payed', 'exams.date')->join('students', 'students.id', '=', 'exams.std_id')->selectRaw('students.name')
            ->join('branches', 'branches.id', '=', 'exams.branch_id')->selectRaw('branches.name AS BrancheName')->get();
        return view('exam/edit')->with('students', $students);
    }
    public function examupdate(Request $req)
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
                case 'payed':
                    $validate[$key] = 'required|max:20';
                    break;
                case 'degree':
                    $validate[$key] = 'required|int';
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
        ExamRecords::where('id', $id)->update([
            'money' => $money,
        ]);
        foreach ($ids as $key => $value) {
            exams::where('std_id', $value)->where('exam_record', $id)->update([
                'degree' => $req['degree_' . $value],
                'payed' => $req['payed_' . $value],
            ]);
        }
        return redirect()->route('lstexm')->with('success', 'The Exam Record (' . $id . ') updated Successfully');
    }
    public function Exm_Excel()
    {
        $secs = Sec_type::all();
        $branches = Branches::all();
        return view('exam.add_excel')->with('secs', $secs)->with('branches', $branches);
    }
    public function Exm_stamp()
    {
        return response()->download(public_path('stamps/exams_stamp.xlsx'), 'exams_stamp.xlsx');
    }
    public function store_excel(ExamsStoreExcel $request)
    {
        ExamRecords::create([
            'date' => $request['date'],
            'Branch_id' => $request['branch'],
            'sec_id' => $request['sec']
        ]);
        $idrecord = ExamRecords::latest('created_at')->get()[0]->id;
        session()->flash('idrecord', $idrecord);
        Excel::import(new ExamsImport, request()->file('sheet'));
        $money = exams::where('attend_record', $idrecord)->sum('payed');
        ExamRecords::where('id', $idrecord)->update([
            'money' => $money
        ]);
        return redirect()->back()->with('success','Exam Has Been Recorded Success');
    }
}
