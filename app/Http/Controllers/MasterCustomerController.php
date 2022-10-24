<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\MasterCustomer;

class MasterCustomerController extends Controller
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
        $kode_customer      = $request->kode_customer;
        $nama_customer      = $request->nama_customer;
        $alamat             = $request->alamat;
        $email              = $request->email;
        $no_telp            = $request->no_telp;
        $fax                = $request->fax;
        $nama_pic           = $request->nama_pic;
        $jabatan_pic        = $request->jabatan_pic;
        $payment_terms      = $request->payment_terms;

        $storeMasterCustomer = MasterCustomer::storeMasterCustomer($kode_customer, $nama_customer, $alamat, $email, $no_telp, $fax, $nama_pic, $jabatan_pic, $payment_terms);

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
        $kode_customer      = $request->kode_customer;
        $nama_customer      = $request->nama_customer;
        $alamat             = $request->alamat;
        $email              = $request->email;
        $no_telp            = $request->no_telp;
        $fax                = $request->fax;
        $nama_pic           = $request->nama_pic;
        $jabatan_pic        = $request->jabatan_pic;
        $payment_terms      = $request->payment_terms;

        $updateMasterCustomer = MasterCustomer::updateMasterCustomer ($id, $kode_customer, $nama_customer, $alamat, $email, $no_telp, $fax, $nama_pic, $jabatan_pic, $payment_terms);

        return redirect('/master-customer')->with('message', 'Data Customer berhasil diubah!');
    }


    public function delete($id)
    {
        $delMasterCustomerbyId = MasterCustomer::delmastercustomerbyId($id);

        return redirect('/master-customer')->with('message', 'Data Customer berhasil dihapus!');
    }
}
