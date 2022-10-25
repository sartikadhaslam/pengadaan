<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananHeader;
use App\Models\PemesananDetail;
use App\Models\PembelianHeader;
use App\Models\PembelianDetail;
use App\Models\MasterCustomer;
use App\Models\MasterPrinciple;
use App\Models\MasterBarang;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use File;

class PembelianController extends Controller
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
        $role = Auth::user()->role;
        $getMasterPrinciple = MasterPrinciple::where('email', Auth::user()->email)->first();
        if($role == 'principle'){
        $pembelianHeader = PembelianHeader::select('pembelian_header.id', 'pembelian_header.no_pembelian', 'pembelian_header.tanggal_pembelian', 'pembelian_header.term_condition', 'master_principle.nama_principle as principle', 'pembelian_header.status')
                              ->join('master_principle', 'master_principle.id', 'pembelian_header.id_principle')
                              ->where('id_principle', $getMasterPrinciple->id)
                              ->where('status', '!=', 'Draft')
                              ->get();
        }else{
        $pembelianHeader = PembelianHeader::select('pembelian_header.id', 'pembelian_header.no_pembelian', 'pembelian_header.tanggal_pembelian', 'master_principle.nama_principle as principle', 'pembelian_header.status')
                                    ->join('master_principle', 'master_principle.id', 'pembelian_header.id_principle')
                                    ->get();
        }
        $no = 1;

        $commandData = [
            'pembelianHeader'           => $pembelianHeader,
            'no'                        => $no,
            'role'                      => $role
        ];
        return view('transaksi.pembelian.index', $commandData);
    }

    public function add()
    {
        $getMasterPrinciple = MasterPrinciple::where('email', Auth::user()->email)->first();

        $getMasterPrincipleAll = MasterPrinciple::get();
        
        $getPemesananHeaderApprove = PemesananHeader::select('pemesanan_header.no_pemesanan', 'master_customer.nama_customer as customer')
                                    ->join('master_customer', 'master_customer.id', 'pemesanan_header.id_customer')
                                    ->where('status', 'Approve')
                                    ->get();
        $commandData = [
            'getMasterPrinciple'     => $getMasterPrinciple,
            'getMasterPrincipleAll'     => $getMasterPrincipleAll,
            'getPemesananHeaderApprove' => $getPemesananHeaderApprove,
        ];
        return view('transaksi.pembelian.add', $commandData);
    }

    public function getDataPrinciple(Request $request){
        $id = $request->get('id');
        $getDataPrinciple = MasterPrinciple::select('id', 'nama_principle', 'alamat', 'no_telp', 'fax')->where('id',$id)->first();

        return response()->json($getDataPrinciple);
    }

    public function store(Request $request)
    {
        $tahun = date('Y');
        
        $bulan = date('m');

        $no_pemesanan       = $request->no_pemesanan;
        $pemesananHeader    = PemesananHeader::where('no_pemesanan', $no_pemesanan)->first();
        $customer           = MasterCustomer::where('id', $pemesananHeader->id_customer)->first();
        $principle          = MasterPrinciple::where('id', $request->id_principle)->first();
        $pemesananDetail    = PemesananDetail::where('id_pemesanan', $pemesananHeader->id)->get();
        $datapemesanan      = $no_pemesanan-$customer->nama_customer;
        $dataprinciple      = $principle->kode_principle-$principle->nama_principle;

        $no = 1;
        
        $max = count($check);

        if($max > 0){
            $kode_pembelian = $no_pemesanan.'/'.'UK'.'/'.$customer->kode_customer.'/'.$bulan.'/'.$tahun;
        }else{
            $kode_pembelian = $no_pemesanan.'/'.'UK'.'/'.$customer->kode_customer.'/'.$bulan.'/'.$tahun;
        } 

        $storePembelianHeader = new PembelianHeader();
        $storePembelianHeader->no_pembelian       = $kode_pembelian;
        $storePembelianHeader->tanggal_pembelian  = $request->tanggal_pembelian;
        $storePembelianHeader->id_principle       = $request->id_principle;
        $storePembelianHeader->alamat_principle   = $request->alamat_principle;
        $storePembelianHeader->telepon_principle  = $request->telepon_principle;
        $storePembelianHeader->fax_principle      = $request->fax_principle;
        $storePembelianHeader->term_condition     = $request->term_condition;
        $storePembelianHeader->status             = 'Draft';
        $storePembelianHeader->save();

        $id_header = $storePembelianHeader->id;

        foreach($pemesananDetail as $pemesananDetail){
            $storePembelianDetail = new PembelianDetail();
            $storePembelianDetail->id_pembelian     = $id_header;
            $storePembelianDetail->id_barang        = $pemesananDetail->id_barang;
            $storePembelianDetail->nama_barang      = $pemesananDetail->nama_barang;
            $storePembelianDetail->unit             = $pemesananDetail->unit;
            $storePembelianDetail->qty              = $pemesananDetail->qty;
            $storePembelianDetail->unit_price       = $pemesananDetail->unit_price;
            $storePembelianDetail->total            = $pemesananDetail->total;
            $storePembelianDetail->save();
        }

        return redirect('/pembelian/edit/'. $id_header)->with('message', 'Data Pembelian berhasil disimpan!');
    
    }

    public function add_detail($id)
    {
        $getMasterPrincipleAll = MasterPrinciple::get();
        $getMasterPrinciple = MasterPrinciple::where('email', Auth::user()->email)->first();
        $getPembelianHeader = PembelianHeader::where('id', $id)->first();
        $getPembelianDetail = PembelianDetail::where('id_pembelian', $id)->get();
        $getMasterBarang    = MasterBarang::get();
        $no = 1;

        $commandData = [
            'getMasterPrinciple'    => $getMasterPrinciple,
            'getPembelianHeader'    => $getPembelianHeader,
            'getPembelianDetail'    => $getPembelianDetail,
            'getMasterBarang'       => $getMasterBarang,
            'no'                    => $no,
            'getMasterPrincipleAll' => $getMasterPrincipleAll
        ];
        return view('transaksi.pembelian.add_detail', $commandData);
    }

    public function update(Request $request, $id)
    {
        $updatePembelianHeader = PembelianHeader::find($id);
        $updatePembelianHeader->term_condition = $request->term_condition;
        $updatePembelianHeader->save();

        return redirect('/pembelian/edit/'. $id)->with('message', 'Data Pembelian berhasil diubah!');

    }

    public function update_status(Request $request,$id)
    {
        if($request->status == 'approve'){
            $status         = 'Approve';
            $no_pemesanan   = strtok($request->no_pembelian, '/');
            
            $pemesanan      = PemesananHeader::where('no_pemesanan', $no_pemesanan)->first();

            $updatePemesananHeader = PemesananHeader::find($pemesanan->id);
            $updatePemesananHeader->status = 'Proses';
            $updatePemesananHeader->save();
        }else{
            $status = 'Ajukan Baru';
        }
        $updateStatus= PembelianHeader::find($id);
        $updateStatus->status = $status;
        $updateStatus->save();
        
        if($request->status == 'approve'){
            return redirect('/pembelian')->with('message', 'Data Pembelian berhasil disetujui!');
        }else{
            return redirect('/pembelian/edit/'. $id)->with('message', 'Data Pembelian berhasil diajukan!');
        }
        
    }


    public function delete($id)
    {
        $delPembelianHeader = PembelianHeader::delPembelianHeader($id);
        $delPemesananDetail = PemesananDetail::delPemesananDetail($id);

        return redirect('/pembelian')->with('message', 'Data Pembelian berhasil dihapus!');
    }
}
