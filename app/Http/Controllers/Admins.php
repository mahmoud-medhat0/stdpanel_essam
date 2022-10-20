<?php

namespace App\Http\Controllers;

use App\Models\admins as adminss;
use Illuminate\Http\Request;
use App\Http\Requests\adminstre;
use App\Http\Requests\adminupdate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Contracts\Validation\Validator;

class Admins extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function list()
    {
      $admins = adminss::all();
      return view('admins.index',compact('admins'));  
    }
    public function add()
    {
        return view('admins.add');
    }
    public function admindelete($id)
    {
        $admin = adminss::find($id);
        $admin->delete();
        return redirect()->back()->with('success', 'Exercise Admin Has Been Deleted Successful');
    }
    public function storeadmin(adminstre $data)
    {
        adminss::create(
            [
                'name' => $data['name'],
                'email' => $data['email'],
                'password' => Hash::make($data['password']),
            ]
            );
            return redirect()->back()->with('success', 'Exercise Admin Has Been Added Successful');
    }
    public function adminupdate(adminupdate $req)
    {
        $id = $req['id'];
        $update = adminss::find($id);
        $update->update(
            [
                'name' => $req['name'],
                'email' => $req['email']            ]
            );
            if(isset($req['password'])){
                $validate1 = array();
                $validate1['password'] = ['password' => ['required','string', 'min:8', 'confirmed']];
                $update->update(
                    [
                        'password' => Hash::make($req['password']),
                    ]
                    );
            }
            $admins = adminss::all();
            return view('admins.index',compact('admins'))->with('success', 'Admin Has Been updated Successful');
    }
    public function edit(Request $req)
    {
        $admin = adminss::find($req['id']);
        return view('admins.update',compact('admin'));
    }
}
