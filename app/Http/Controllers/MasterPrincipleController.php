<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterPrinciple;
use App\Models\MasterCustomer;

class MasterPrincipleController extends Controller
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
        $getMasterPrinciple = MasterPrinciple::getMasterPrinciple();
        $no = 1;

        $commandData = [
            'getMasterPrinciple' => $getMasterPrinciple,
            'no' => $no,
        ];
        return view('master.masterprinciple.index', $commandData);
    }

    public function add()
    {
        return view('master.masterprinciple.add');
    }


    public function store(Request $request)
    {
        $nama_principle     = $request->nama_principle;
        $alamat             = $request->alamat;
        $email              = $request->email;
        $no_telp            = $request->no_telp;
        $fax                = $request->fax;
        $nama_pic           = $request->nama_pic;
        $jabatan_pic        = $request->jabatan_pic;

        $storeMasterPrinciple = MasterPrinciple::storeMasterPrinciple($nama_principle, $alamat, $email, $no_telp, $fax, $nama_pic, $jabatan_pic);

        return redirect('/master-principle')->with('message', 'Data Principle berhasil disimpan!');
    }


    public function edit($id)
    {
        $getMasterPrinciplebyId = MasterPrinciple::getMasterPrinciplebyId($id);

        $commandData = [
            'getMasterPrinciplebyId' => $getMasterPrinciplebyId,
        ];

        return view('master.masterprinciple.edit', $commandData);
    }


    public function update(Request $request, $id)
    {
        $nama_principle     = $request->nama_principle;
        $alamat             = $request->alamat;
        $email              = $request->email;
        $no_telp            = $request->no_telp;
        $fax                = $request->fax;
        $nama_pic           = $request->nama_pic;
        $jabatan_pic        = $request->jabatan_pic;


        $updateMasterPrinciple = MasterPrinciple::updateMasterPrinciple($id, $nama_principle, $alamat, $email, $no_telp, $fax, $nama_pic, $jabatan_pic);

        return redirect('/master-principle')->with('message', 'Data Principle berhasil diubah!');
    }


    public function delete($id)
    {
        $delMasterPrinciplebyId = MasterPrinciple::delMasterPrinciplebyId($id);

        return redirect('/master-principle')->with('message', 'Data Principle berhasil dihapus!');
    }
}
