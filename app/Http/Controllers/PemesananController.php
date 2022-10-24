<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananHeader;
use App\Models\PemesananDetail;
use App\Models\MasterCustomer;
use App\Models\MasterBarang;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use File;

class PemesananController extends Controller
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
        if($role == 'customer'){
        $getMasterCustomer  = MasterCustomer::where('email', Auth::user()->email)->first();
        $pemesananHeader    = PemesananHeader::select('pemesanan_header.id', 'pemesanan_header.no_pemesanan', 'pemesanan_header.tanggal_pemesanan', 'master_customer.nama_customer as customer', 'pemesanan_header.delivery_deadline', 'pemesanan_header.status')
                              ->join('master_customer', 'master_customer.id', 'pemesanan_header.id_customer')
                              ->where('id_customer', $getMasterCustomer->id)
                              ->paginate(10);
        }else{
        $pemesananHeader    = PemesananHeader::select('pemesanan_header.id', 'pemesanan_header.no_pemesanan', 'pemesanan_header.tanggal_pemesanan', 'master_customer.nama_customer as customer', 'pemesanan_header.delivery_deadline', 'pemesanan_header.status')
                              ->join('master_customer', 'master_customer.id', 'pemesanan_header.id_customer')
                              ->where('status', '!=', 'Draft')
                              ->paginate(10);
        }
        $no = 1;

        $commandData = [
            'pemesananHeader'    => $pemesananHeader,
            'no' => $no,
            'role' => $role
        ];
        return view('transaksi.pemesanan.index', $commandData);
    }

    public function add()
    {
        $getMasterCustomer = MasterCustomer::where('email', Auth::user()->email)->first();
        $commandData = [
            'getMasterCustomer'     => $getMasterCustomer,
        ];
        return view('transaksi.pemesanan.add', $commandData);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'file'          => 'required|max:25000',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            
            if ($file = $request->file('file')) {
                $filename           = $request->file('file')->getClientOriginalName();
                $destinationPath    = 'uploads/';
                $profileFile        = date('YmdHis') . "_" . $filename;
                
                $file->move($destinationPath, $profileFile);
               
            }

            $storePemesananHeader = new PemesananHeader();
            $storePemesananHeader->no_pemesanan       = $request->no_pemesanan;
            $storePemesananHeader->tanggal_pemesanan  = $request->tanggal_pemesanan;
            $storePemesananHeader->id_customer        = $request->id_customer;
            $storePemesananHeader->alamat_customer    = $request->alamat_customer;
            $storePemesananHeader->telepon_customer   = $request->telepon_customer;
            $storePemesananHeader->fax_customer       = $request->fax_customer;
            $storePemesananHeader->ship_to            = $request->ship_to;
            $storePemesananHeader->delivery_deadline  = $request->delivery_deadline;
            $storePemesananHeader->payment_terms      = $request->payment_terms;
            $storePemesananHeader->remark             = $request->remark;
            $storePemesananHeader->file               = $profileFile;
            $storePemesananHeader->status             = 'Draft';
            $storePemesananHeader->save();
    
            return redirect('/pemesanan/edit/'. $storePemesananHeader->id)->with('message', 'Data Pemesanan berhasil disimpan!');
        }
    }

    public function add_detail($id)
    {
        $getMasterCustomer  = MasterCustomer::where('email', Auth::user()->email)->first();
        $getPemesananHeader = PemesananHeader::where('id', $id)->first();
        $getPemesananDetail = PemesananDetail::where('id_pemesanan', $id)->get();
        $getMasterBarang    = MasterBarang::get();
        $no = 1;

        $commandData = [
            'getMasterCustomer'     => $getMasterCustomer,
            'getPemesananHeader'    => $getPemesananHeader,
            'getPemesananDetail'    => $getPemesananDetail,
            'getMasterBarang'       => $getMasterBarang,
            'no'                    => $no,
        ];
        return view('transaksi.pemesanan.add_detail', $commandData);
    }

    public function store_detail(Request $request)
    {
        $getPemesananHeader = PemesananHeader::where('id', $request->id_pemesanan)->first();
        $getMasterBarang    = MasterBarang::where('id', $request->id_barang)->first();

        $storePemesananDetail = new PemesananDetail();
        $storePemesananDetail->id_pemesanan     = $request->id_pemesanan;
        $storePemesananDetail->id_barang        = $request->id_barang;
        $storePemesananDetail->nama_barang      = $getMasterBarang->nama_barang;
        $storePemesananDetail->unit             = $getMasterBarang->unit;
        $storePemesananDetail->qty              = $request->qty;
        $storePemesananDetail->unit_price       = $getMasterBarang->harga_jual;
        $storePemesananDetail->total            = $request->qty*$getMasterBarang->harga_jual;
        $storePemesananDetail->save();

        return redirect('/pemesanan/edit/'. $getPemesananHeader->id)->with('message', 'Data Pemesanan berhasil disimpan!');
    }

    public function update(Request $request, $id)
    {
        if($request->file == null){
            $updatePemesananHeader = PemesananHeader::find($id);
            $updatePemesananHeader->no_pemesanan       = $request->no_pemesanan;
            $updatePemesananHeader->ship_to            = $request->ship_to;
            $updatePemesananHeader->delivery_deadline  = $request->delivery_deadline;
            $updatePemesananHeader->remark             = $request->remark;
            $updatePemesananHeader->save();
            return redirect('/pemesanan/edit/'. $updatePemesananHeader->id)->with('message', 'Data Pemesanan berhasil diubah!');
        }else{
            $validator = Validator::make($request->all(),[
                'file'          => 'required|max:25000',
            ]);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $getPemesananHeader = PemesananHeader::find($id);
                File::delete(public_path('uploads/' . $getPemesananHeader->file));
                
                if ($file = $request->file('file')) {
                    $filename           = $request->file('file')->getClientOriginalName();
                    $destinationPath    = 'uploads/';
                    $profileFile        = date('YmdHis') . "_" . $filename;
                    
                    $file->move($destinationPath, $profileFile);
                   
                }
    
                $updatePemesananHeader = PemesananHeader::find($id);
                $updatePemesananHeader->no_pemesanan       = $request->no_pemesanan;
                $updatePemesananHeader->ship_to            = $request->ship_to;
                $updatePemesananHeader->delivery_deadline  = $request->delivery_deadline;
                $updatePemesananHeader->remark             = $request->remark;
                $updatePemesananHeader->file               = $profileFile;
                $updatePemesananHeader->save();
        
                return redirect('/pemesanan/edit/'. $getPemesananHeader->id)->with('message', 'Data Pemesanan berhasil diubah!');
            }
        }
    }

    public function update_status(Request $request,$id)
    {
        if($request->status == 'approve'){
            $status = 'Approve';
        }else{
            $status = 'Ajukan Baru';
        }
        $updateStatus= PemesananHeader::find($id);
        $updateStatus->status = $status;
        $updateStatus->save();
        
        if($request->status == 'approve'){
            return redirect('/pemesanan')->with('message', 'Data Pemesanan berhasil disetujui!');
        }else{
            return redirect('/pemesanan/edit/'. $id)->with('message', 'Data Pemesanan berhasil diajukan!');
        }
        
    }


    public function delete($id)
    {
        $getPemesananHeader = PemesananHeader::where('id', $id)->first();
        File::delete(public_path('uploads/' . $getPemesananHeader->file));
        $delPemesananHeader = PemesananHeader::delPemesananHeader($id);

        return redirect('/pemesanan')->with('message', 'Data Pemesanan berhasil dihapus!');
    }

    public function delete_detail($id)
    {
        $getPemesananDetail = PemesananDetail::where('id', $id)->first();
        $getPemesananHeader = PemesananHeader::where('id', $getPemesananDetail->id_pemesanan)->first();
        $delPemesananDetail = PemesananDetail::delPemesananDetail($id);

        return redirect('/pemesanan/edit/'. $getPemesananHeader->id)->with('message', 'Data Pemesanan Detail berhasil dihapus!');
    }
}
