<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    
    public function index(){
        $getMasterUser = User::getMasterUser();
        $no = 1;

        $commandData = [
            'getMasterUser' => $getMasterUser,
            'no' => $no,
        ];
        return view('master.masteruser.index', $commandData);
    }

    public function add()
    {
        return view('master.masteruser.add');
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'password' => 'required|confirmed|min:6'
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            $name       = $request->name;
            $email      = $request->email;
            $password   = Hash::make($request->password);
            $role       = $request->role;

            $storeMasterUser = User::storeMasterUser($name, $email, $password, $role);

            return redirect('/master-user')->with('message', 'Data User berhasil disimpan!');
        }
    }


    public function edit($id)
    {
        $getMasterUserbyId = User::getMasterUserbyId($id);

        $commandData = [
            'getMasterUserbyId' => $getMasterUserbyId,
        ];

        return view('master.masteruser.edit', $commandData);
    }


    public function update(Request $request, $id)
    {
        $name       = $request->name;
        $email      = $request->email;
        $role       = $request->role;

        $updateMasterUser = User::updateMasterUser($id, $name, $email, $role);

        return redirect('/master-user')->with('message', 'Data User berhasil diubah!');
    }


    public function delete($id)
    {
        $delMasterUserbyId = User::delMasterUserbyId($id);

        return redirect('/master-user')->with('message', 'Data User berhasil dihapus!');
    }
}
