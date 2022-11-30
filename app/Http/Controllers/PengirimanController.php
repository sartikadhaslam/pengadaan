<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananHeader;
use App\Models\PemesananDetail;
use App\Models\PengirimanHeader;
use App\Models\PengirimanDetail;
use App\Models\MasterCustomer;
use App\Models\MasterBarang;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use File;
use PDF;

class PengirimanController extends Controller
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
        $pengirimanHeader = PengirimanHeader::select('pengiriman_header.id', 'pengiriman_header.no_pemesanan', 'pengiriman_header.tanggal', 'master_customer.id as id_customer', 'master_customer.nama_customer as nama_customer', 'pengiriman_header.status')
                            ->join('master_customer', 'master_customer.id', 'pengiriman_header.id_customer')
                            ->paginate(5);     
        $no = 1;

        $commandData = [
            'role'                      => $role,
            'pengirimanHeader'          => $pengirimanHeader,
            'no'                        => $no,
        ];
        return view('transaksi.pengiriman.index', $commandData);
    }

    public function add()
    {
        $pemesananHeader = PemesananHeader::select('pemesanan_header.id', 'pemesanan_header.no_pemesanan', 'pemesanan_header.id_customer', 'master_customer.nama_customer as customer', 'pemesanan_header.status')
                            ->join('master_customer', 'master_customer.id', 'pemesanan_header.id_customer')
                            ->where('pemesanan_header.status', 'Proses')
                            ->get();
        $commandData = [
            'pemesananHeader'       => $pemesananHeader,
        ];
        return view('transaksi.pengiriman.add', $commandData);
    }

    public function getDataPemesanan(Request $request){
        $no_pemesanan = $request->get('id');
        $getDataPemesanan = PemesananHeader::select('id', 'ship_to', 'payment_terms')->where('no_pemesanan',$no_pemesanan)->first();

        return response()->json($getDataPemesanan);
    }

    public function store(Request $request)
    {

        $tahun = date('Y');

        function getRomawi($bulan){
        	switch ($bulan){
                    case 1: 
                        return "I";
                        break;
                    case 2:
                        return "II";
                        break;
                    case 3:
                        return "III";
                        break;
                    case 4:
                        return "IV";
                        break;
                    case 5:
                        return "V";
                        break;
                    case 6:
                        return "VI";
                        break;
                    case 7:
                        return "VII";
                        break;
                    case 8:
                        return "VIII";
                        break;
                    case 9:
                        return "IX";
                        break;
                    case 10:
                        return "X";
                        break;
                    case 11:
                        return "XI";
                        break;
                    case 12:
                        return "XII";
                        break;
              }
        }
        $bulan = date('m');

        $romawi = getRomawi($bulan);

        $no_pemesanan       = $request->no_pemesanan;
        $pemesananHeader    = PemesananHeader::where('no_pemesanan', $no_pemesanan)->first();
        $customer           = MasterCustomer::where('id', $pemesananHeader->id_customer)->first();
        $pemesananDetail    = PemesananDetail::where('id_pemesanan', $pemesananHeader->id)->get();

        $no = 1;
        $now = Carbon::now();
        $check = PengirimanHeader::whereMonth('created_at', $now->month)->get();
        $max = count($check);

        if($max > 0){
            $kode_sj = 'No.'.sprintf("%03s", abs($max + 1)).'/UK-SJ/'.$romawi.'/'.$tahun;
            $kode_in = $bulan.'-'.date('y').sprintf("%03s", abs($max + 1)).'/UK-'.$customer->kode_customer.'/'.$romawi.'/'.date('y');
        }else{
            $kode_sj = 'No.'.sprintf("%03s", $no).'/UK-SJ/'.$romawi.'/'.$tahun;
            $kode_in = $bulan.'-'.date('y').sprintf("%03s", $no).'/UK-'.$customer->kode_customer.'/'.$romawi.'/'.date('y');
        } 
        
        $storePengirimanHeader = new PengirimanHeader();
        $storePengirimanHeader->no_pemesanan       = $no_pemesanan;
        $storePengirimanHeader->tanggal            = $request->tanggal;
        $storePengirimanHeader->id_customer        = $customer->id;
        $storePengirimanHeader->no_surat_jalan     = $kode_sj;
        $storePengirimanHeader->no_invoice         = $kode_in;
        $storePengirimanHeader->delivery_to        = $request->delivery_to;
        $storePengirimanHeader->payment_terms      = $request->payment_terms;
        $storePengirimanHeader->gross_weight       = $request->gross_weight;
        $storePengirimanHeader->dimensi            = $request->dimensi;
        $storePengirimanHeader->status             = 'Dikirim';
        $storePengirimanHeader->save();

        $id_header = $storePengirimanHeader->id;

        foreach($pemesananDetail as $pemesananDetail){
            $barang = MasterBarang::where('id', $pemesananDetail->id_barang)->first();

            $storePengirimanDetail = new PengirimanDetail();
            $storePengirimanDetail->id_pengiriman    = $id_header;
            $storePengirimanDetail->id_barang        = $pemesananDetail->id_barang;
            $storePengirimanDetail->nama_barang      = $pemesananDetail->nama_barang;
            $storePengirimanDetail->unit             = $pemesananDetail->unit;
            $storePengirimanDetail->qty              = $pemesananDetail->qty;
            $storePengirimanDetail->unit_price       = $pemesananDetail->unit_price;
            $storePengirimanDetail->total            = $pemesananDetail->total;
            $storePengirimanDetail->save();
        }

        $updatePemesananHeader = PemesananHeader::find($pemesananHeader->id);
        $updatePemesananHeader->status = 'Dikirim';
        $updatePemesananHeader->save();

        return redirect('/pengiriman/edit/'. $id_header)->with('message', 'Data Pengiriman berhasil disimpan!');
    }

    public function add_detail($id)
    {
        $getPengirimanHeader = PengirimanHeader::select('pengiriman_header.id', 'pengiriman_header.no_pemesanan', 'pengiriman_header.tanggal', 'pengiriman_header.no_surat_jalan', 'pengiriman_header.no_invoice', 'pengiriman_header.delivery_to', 'pengiriman_header.payment_terms', 'master_customer.id as id_customer', 'master_customer.nama_customer as nama_customer', 'pengiriman_header.status', 'pengiriman_header.gross_weight', 'pengiriman_header.dimensi')
                            ->join('master_customer', 'master_customer.id', 'pengiriman_header.id_customer')
                            ->where('pengiriman_header.id', $id)
                            ->first(); 
        $getPengirimanDetail    = PengirimanDetail::where('id_pengiriman', $id)->get();
        $no = 1;

        $commandData = [
            'getPengirimanHeader'    => $getPengirimanHeader,
            'getPengirimanDetail'    => $getPengirimanDetail,
            'no'                     => $no,
        ];
        return view('transaksi.pengiriman.add_detail', $commandData);
    }

    public function update_status(Request $request,$id)
    {
        $updateStatus= PengirimanHeader::find($id);
        $updateStatus->status = 'Selesai';
        $updateStatus->save(); 

        $no_pemesanan       = $updateStatus->no_pemesanan;
        $pemesananHeader    = PemesananHeader::where('no_pemesanan', $no_pemesanan)->first();
        $updatePemesananHeader = PemesananHeader::find($pemesananHeader->id);
        $updatePemesananHeader->status = 'Selesai';
        $updatePemesananHeader->save();

        return redirect('/pengiriman/edit/'. $id)->with('message', 'Status berhasil diupdate!');
    }

    public function delete($id)
    {
        $delPengirimanHeader    = PengirimanHeader::delPengirimanHeader($id);
        $pengirimanDetail       = PengirimanDetail::where('id_pengiriman', $id)->first();
        $delPengirimanDetail    = PengirimanDetail::delPengirimanDetail($pengirimanDetail->id);

        return redirect('/pengiriman')->with('message', 'Data Pengiriman berhasil dihapus!');
    }

    public function cetak_sj($id)
    {
    	$pengirimanHeader = PengirimanHeader::find($id);
        $pengirimanDetail = PengirimanDetail::select('pengiriman_detail.id', 'pengiriman_detail.id_pengiriman', 'pengiriman_detail.id_barang',  'pengiriman_detail.nama_barang', 'pengiriman_detail.unit', 'pengiriman_detail.qty', 'pengiriman_detail.unit_price', 'pengiriman_detail.total' , 'master_barang.kode_barang')
                            ->join('master_barang', 'master_barang.id', 'pengiriman_detail.id_barang')
                            ->where('id_pengiriman',$id)
                            ->get();
        $total  = 0;
        $qty    = 0;
        foreach($pengirimanDetail as $val){
            $total  = $total+$val->total;
            $qty    = $qty+$val->qty;
        }
        $masterCustomer = MasterCustomer::where('id',$pengirimanHeader->id_customer)->first();
        $no = 1 ;
 
    	$pdf = PDF::loadview('transaksi.pengiriman.surat_jalan',['qty'=>$qty, 'total'=>$total, 'pengirimanHeader'=>$pengirimanHeader, 'pengirimanDetail'=>$pengirimanDetail, 'masterCustomer'=> $masterCustomer, 'no'=>$no]);
    	return $pdf->stream('Surat_Jalan'.$pengirimanHeader->id.$pengirimanHeader->created_at.'.pdf');
    }

    public function cetak_in($id)
    {
    	$pengirimanHeader = PengirimanHeader::find($id);
        $pengirimanDetail = PengirimanDetail::select('pengiriman_detail.id', 'pengiriman_detail.id_pengiriman', 'pengiriman_detail.id_barang',  'pengiriman_detail.nama_barang', 'pengiriman_detail.unit', 'pengiriman_detail.qty', 'pengiriman_detail.unit_price', 'pengiriman_detail.total' , 'master_barang.kode_barang')
                            ->join('master_barang', 'master_barang.id', 'pengiriman_detail.id_barang')
                            ->where('id_pengiriman',$id)
                            ->get();
        $total  = 0;
        $qty    = 0;
        foreach($pengirimanDetail as $val){
            $total  = $total+$val->total;
            $qty    = $qty+$val->qty;
        }
        $masterCustomer = MasterCustomer::where('id',$pengirimanHeader->id_customer)->first();
        $no = 1 ;
 
    	$pdf = PDF::loadview('transaksi.pengiriman.invoice',['qty'=>$qty, 'total'=>$total, 'pengirimanHeader'=>$pengirimanHeader, 'pengirimanDetail'=>$pengirimanDetail, 'masterCustomer'=> $masterCustomer, 'no'=>$no]);
    	return $pdf->stream('Invoice'.$pengirimanHeader->id.$pengirimanHeader->created_at.'.pdf');
    }
}
