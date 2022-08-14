<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananHeader;
use App\Models\PemesananDetail;
use App\Models\MasterCustomer;
use App\Models\MasterBarang;


class PemesananController extends Controller
{
    public function index(){
        $datas = PemesananHeader::orderBy('id','desc')->get();
        $no = 1;

        $commandData = [
            'datas' => $datas,
            'no' => $no,
        ];
        return view('transaksi.pemesanan.index', $commandData);
    }

    public function add()
    {
        $customer = MasterCustomer::get();
        return view('transaksi.pemesanan.add',compact('customer'));
    }


    public function store(Request $request)
    {
        $form = $request->all();
        $customer = MasterCustomer::find($request->id_customer);
        $form['alamat_customer'] = $customer->alamat;
        $form['telepon_customer'] = $customer->no_telp;
        $form['nama_customer'] = $customer->nama_customer;
        $form['status'] = 'proses';
        $form['tanggal_pemesanan'] = date("Y-m-d");

        $last = PemesananHeader::where('tanggal_pemesanan',$form['tanggal_pemesanan'])
        ->orderBy('no_pemesanan', 'desc')->first();

        if(isset($last)){
            $no = substr($last->no_pemesanan, -4);
            $no = str_pad(intval($no) + 1, strlen($no), '0', STR_PAD_LEFT);

            $form['no_pemesanan'] = 'CO'.date('Ymd').$no;
        }else{
            $form['no_pemesanan'] = 'CO'.date('Ymd').'0001';
        }

        PemesananHeader::create($form);

        return redirect('pemesanan')->with('message', 'Data berhasil disimpan!');
    }


    public function edit($id)
    {
        $data = PemesananHeader::find($id);
        $customer = MasterCustomer::get();
        $barang = MasterBarang::get();
        $detail = PemesananDetail::where('id_pemesanan',$id)->get();
        $no = 1;

        $commandData = [
            'data' => $data,
            'customer' => $customer,
            'barang' => $barang,
            'detail' => $detail,
            'no' => $no,
        ];

        return view('transaksi.pemesanan.edit', $commandData);
    }


    public function update(Request $request, $id)
    {
        $form = $request->all();

        $updateMasterPrinciple = PemesananHeader::find($id)->update($form);

        return redirect('/pemesanan')->with('message', 'Data berhasil diubah!');
    }


    public function delete($id)
    {
        $delete = PemesananHeader::find($id)->delete();

        return redirect('/pemesanan')->with('message', 'Data berhasil dihapus!');
    }
    
    public function storeDetail(Request $request)
    {
        $form = $request->all();
        $barang = MasterBarang::find($request->id_barang);
        $form['nama_barang'] = $barang->nama_barang;
        $form['unit_price'] = $barang->harga;
        $form['total'] = $barang->harga*$request->qty;

        PemesananDetail::create($form);

        return redirect()->back()->with(['success' => 'Data Berhasil Diubah']); ;
    }
    
    public function deleteDetail($id)
    {
        $delete = PemesananDetail::find($id)->delete();

        return redirect()->back()->with(['success' => 'Data Berhasil Dihapus']);
    }
}
