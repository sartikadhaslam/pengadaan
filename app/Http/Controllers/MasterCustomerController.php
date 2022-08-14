<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterCustomer;

class MasterCustomerController extends Controller
{
    public function index(){
        $getMasterCustomer = MasterCustomer::getMasterCustomer();
        $no = 1;

        $commandData = [
            'getMasterCustomer' => $getMasterCustomer,
            'no' => $no,
        ];
        return view('master.mastercustomer.index', $commandData);
    }

    public function add()
    {
        return view('master.mastercustomer.add');
    }


    public function store(Request $request)
    {
        $nama_customer = $request->nama_customer;
        $alamat = $request->alamat;
        $no_telp = $request->no_telp;
        $nama_pic = $request->nama_pic;

        $storeMasterCustomer = MasterCustomer::storeMasterCustomer($nama_customer, $alamat, $no_telp, $nama_pic);

        return redirect('/master-customer')->with('message', 'Data Customer berhasil disimpan!');
    }


    public function edit($id)
    {
        $getMasterCustomerbyId = MasterCustomer::getMasterCustomerbyId($id);

        $commandData = [
            'getMasterCustomerbyId' => $getMasterCustomerbyId,
        ];

        return view('master.mastercustomer.edit', $commandData);
    }


    public function update(Request $request, $id)
    {
        $nama_customer = $request->nama_customer;
        $alamat = $request->alamat;
        $no_telp = $request->no_telp;
        $nama_pic = $request->nama_pic;


        $updateMasterCustomer = MasterCustomer::updateMasterCustomer ($id, $nama_customer, $alamat, $no_telp, $nama_pic);

        return redirect('/master-customer')->with('message', 'Data Customer berhasil diubah!');
    }


    public function delete($id)
    {
        $delMasterCustomerbyId = MasterCustomer::delmastercustomerbyId($id);

        return redirect('/master-customer')->with('message', 'Data Customer berhasil dihapus!');
    }
}
