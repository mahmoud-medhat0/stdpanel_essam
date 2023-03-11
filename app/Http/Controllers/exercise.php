<?php

namespace App\Http\Controllers;

use App\Models\Branches;
use App\Models\Sec_type;
use App\Models\students;
use Illuminate\Http\Request;
use App\Http\Requests\delexc;
use App\Models\ExerciseRecords;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\exerciseedit;
use App\Http\Requests\exercisestore;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\exerciseupdate;
use App\Http\Requests\ExerciseStoreExcel;
use App\Imports\ExerciseImport;
use App\Models\exercise as ModelsExercise;

class exercise extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function exerciseadd()
    {
        $secs = Sec_type::all();
        return view('exercise/add')->with('secs', $secs);
    }
    public function add_exc($id)
    {
        $branches = Branches::all();
        $students = students::where('sec_type_id', $id)->where('verified', '1')->get();
        session()->flash('sec', $id);
        return view('exercise.add_exercise')->with('students', $students)->with('branches', $branches);
    }

    public function exercisestore(exercisestore $req)
    {
        $sec = session()->get('sec');
        $rs = $req->except('_token', 'sec', 'date', 'branch');
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
                    $validate[$key] = 'nullable|double';
                    break;
            }
        }
        $req->validate($validate);
        ExerciseRecords::create([
            'date' => $req['date'],
            'Branch_id' => $req['branch'],
            'sec_id' => $sec
        ]);
        $ExerciseRecord = ExerciseRecords::latest('created_at')->get()[0]->id;
        foreach ($ids as $key => $value) {
            ModelsExercise::create([
                'std_id' => $value,
                'date' => $req['date'],
                'degree' => $req['degree_' . $value],
                'branch_id' => $req['branch'],
                'sec_type_id' => $sec,
                'Exercise_Record' => $ExerciseRecord
            ]);
        }
        return redirect()->back()->with('success', 'Exercise Record(' . $ExerciseRecord . ') Has Been Added Successful');
    }

    public function exerciselist()
    {
        $secs = Sec_type::all();
        return view('exercise/index')->with('secs', $secs);
    }
    public function lst_exc($id)
    {
        $exercises = ExerciseRecords::where('sec_id', $id)->select('exercise_records.date', 'exercise_records.id', 'exercise_records.created_at')->join('branches', 'branches.id', '=', 'exercise_records.Branch_id')->selectRaw('branches.name')->get();
        return view('exercise.index_exercise')->with('exercises', $exercises);
    }
    public function readexercise($id)
    {
        $exercises = ModelsExercise::where('Exercise_Record', $id)->select('exercises.std_id', 'exercises.date', 'exercises.degree')->join('students', 'students.id', '=', 'exercises.std_id')->selectRaw('students.name')->get();
        session()->flash('idrecord', $id);
        return view('exercise/edit')->with('exercises', $exercises);
    }
    public function exerciseupdate(exerciseupdate $req)
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
                case 'degree':
                    $validate[$key] = 'required|int';
                    break;
            }
        }
        $req->validate($validate);
        foreach ($ids as $key => $value) {
            ModelsExercise::where('std_id', $value)->where('Exercise_Record', $id)->update([
                'degree' => $req['degree_' . $value],
            ]);
        }
        return redirect()->route('exerciselist')->with('success', 'The Exam Record (' . $id . ') updated Successfully')->withInput();
    }
    public function exercisedelete($id)
    {
        ModelsExercise::where('Exercise_Record',$id)->delete();
        ExerciseRecords::where('id',$id)->delete();
        return redirect()->back()->with('success', 'The Exercise(' .$id. ') Record Deleted Successfully');
    }
    public function exercise_Excel()
    {
        $secs = Sec_type::all();
        $branches = Branches::all();
        return view('exercise.add_excel')->with('secs', $secs)->with('branches', $branches);
    }
    public function exercise_stamp()
    {
        return response()->download(public_path('stamps/exercises_stamp.xlsx'), 'exercises_stamp.xlsx');
    }
    public function store_excel(ExerciseStoreExcel $request)
    {
        ExerciseRecords::create([
            'date'=>$request['date'],
            'Branch_id'=>$request['branch'],
            'sec_id'=>$request['sec'],
            'maximum'=>$request['maximum']
        ]);
        $idrecord = ExerciseRecords::latest('created_at')->get()[0]->id;
        session()->flash('idrecord',$idrecord);
        $importer = new ExerciseImport;
        $importer->import(request()->file('sheet'));
        if ($importer->failures()->isNotEmpty()) {
            return redirect()->back()->withFailures($importer->failures());
        }
        // Excel::import(new ExerciseImport,request()->file('sheet'));
        return redirect()->back()->with('success','Exercise Has Been Recorded Success');
    }
}
