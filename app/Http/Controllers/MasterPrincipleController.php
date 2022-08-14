<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterPrinciple;

class MasterPrincipleController extends Controller
{
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
        $nama_principle = $request->nama_principle;
        $alamat = $request->alamat;
        $no_telp = $request->no_telp;
        $nama_pic = $request->nama_pic;

        $storeMasterPrinciple = MasterPrinciple::storeMasterPrinciple($nama_principle, $alamat, $no_telp, $nama_pic);

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
        $nama_principle = $request->nama_principle;
        $alamat = $request->alamat;
        $no_telp = $request->no_telp;
        $nama_pic = $request->nama_pic;


        $updateMasterPrinciple = MasterPrinciple::updateMasterPrinciple($id, $nama_principle, $alamat, $no_telp, $nama_pic);

        return redirect('/master-principle')->with('message', 'Data Principle berhasil diubah!');
    }


    public function delete($id)
    {
        $delMasterPrinciplebyId = MasterPrinciple::delMasterPrinciplebyId($id);

        return redirect('/master-principle')->with('message', 'Data Principle berhasil dihapus!');
    }
}
