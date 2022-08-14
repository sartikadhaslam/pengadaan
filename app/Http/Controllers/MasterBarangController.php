<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterBarang;

class MasterBarangController extends Controller
{
    public function index(){
        $getMasterBarang = MasterBarang::getMasterBarang();
        $no = 1;

        $commandData = [
            'getMasterBarang' => $getMasterBarang,
            'no' => $no,
        ];
        return view('master.masterbarang.index', $commandData);
    }

    public function add()
    {
        return view('master.masterbarang.add');
    }


    public function store(Request $request)
    {
        $nama_barang = $request->nama_barang;
        $harga = $request->harga;

        $storeMasterBarang = MasterBarang::storeMasterBarang($nama_barang, $harga);

        return redirect('/master-barang')->with('message', 'Data Barang berhasil disimpan!');
    }


    public function edit($id)
    {
        $getMasterBarangbyId = MasterBarang::getMasterBarangbyId($id);

        $commandData = [
            'getMasterBarangbyId' => $getMasterBarangbyId,
        ];

        return view('master.masterbarang.edit', $commandData);
    }


    public function update(Request $request, $id)
    {
        $nama_barang = $request->nama_barang;
        $harga = $request->harga;

        $updateMasterBarang = MasterBarang::updateMasterBarang($id, $nama_barang, $harga);

        return redirect('/master-barang')->with('message', 'Data Barang berhasil diubah!');
    }


    public function delete($id)
    {
        $delMasterBarangbyId = MasterBarang::delMasterBarangbyId($id);

        return redirect('/master-barang')->with('message', 'Data Barang berhasil dihapus!');
    }
}
