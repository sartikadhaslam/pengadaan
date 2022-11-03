<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananHeader;
use App\Models\PemesananDetail;
use App\Models\PembelianHeader;
use App\Models\PembelianDetail;
use App\Models\PenerimaanHeader;
use App\Models\PenerimaanDetail;
use App\Models\MasterCustomer;
use App\Models\MasterPrinciple;
use App\Models\MasterBarang;
use Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use File;
use PDF;

class PenerimaanController extends Controller
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
        $penerimaanHeader = PenerimaanHeader::select('penerimaan_header.id', 'penerimaan_header.no_pembelian', 'penerimaan_header.tanggal_penerimaan', 'master_principle.id as id_principle', 'master_principle.nama_principle as nama_principle', 'penerimaan_header.status')
                            ->join('master_principle', 'master_principle.id', 'penerimaan_header.id_principle')
                            ->paginate(5);     
                            
        $getMasterPrincipleAll = MasterPrinciple::get();
        
        $no = 1;

        $commandData = [
            'penerimaanHeader'          => $penerimaanHeader,
            'no'                        => $no,
            'getMasterPrincipleAll'     => $getMasterPrincipleAll
        ];
        return view('transaksi.penerimaan.index', $commandData);
    }

    public function add()
    {
        $getMasterPrincipleAll = MasterPrinciple::get();
        
        $pembelianHeader = PembelianHeader::select('pembelian_header.id', 'pembelian_header.no_pembelian', 'pembelian_header.id_principle', 'pembelian_header.tanggal_pembelian', 'master_principle.nama_principle as principle', 'pembelian_header.status')
                                    ->join('master_principle', 'master_principle.id', 'pembelian_header.id_principle')
                                    ->get();
        $commandData = [
            'getMasterPrincipleAll' => $getMasterPrincipleAll,
            'pembelianHeader'       => $pembelianHeader,
        ];
        return view('transaksi.penerimaan.add', $commandData);
    }


    public function store(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'surat_tagihan' => 'required|max:25000',
            'packing_list'  => 'required|max:25000',
        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }else{
            
            if ($file = $request->file('surat_tagihan')) {
                $filename           = $request->file('surat_tagihan')->getClientOriginalName();
                $destinationPath    = 'uploads/';
                $profileST          = date('YmdHis') . "_" . $filename;
                
                $file->move($destinationPath, $profileST);
            }

            if ($file = $request->file('packing_list')) {
                $filename           = $request->file('packing_list')->getClientOriginalName();
                $destinationPath    = 'uploads/';
                $profilePL          = date('YmdHis') . "_" . $filename;
                
                $file->move($destinationPath, $profilePL);
            }

            
            $no_pembelian       = $request->no_pembelian;
            $pembelianHeader    = PembelianHeader::where('no_pembelian', $no_pembelian)->first();
            $pembelianDetail    = PembelianDetail::where('id_pembelian', $pembelianHeader->id)->get();

            $storePenerimaanHeader = new PenerimaanHeader();
            $storePenerimaanHeader->no_pembelian       = $request->no_pembelian;
            $storePenerimaanHeader->tanggal_penerimaan = $request->tanggal_penerimaan;
            $storePenerimaanHeader->id_principle       = $pembelianHeader->id_principle;
            $storePenerimaanHeader->surat_tagihan      = $profileST;
            $storePenerimaanHeader->packing_list       = $profilePL;
            $storePenerimaanHeader->nama_pengirim      = $request->nama_pengirim;
            $storePenerimaanHeader->hp_pengirim        = $request->hp_pengirim;
            $storePenerimaanHeader->status             = 'Diterima';
            $storePenerimaanHeader->save();

            $id_header = $storePenerimaanHeader->id;

            foreach($pembelianDetail as $pembelianDetail){
                $storePenerimaanDetail = new PenerimaanDetail();
                $storePenerimaanDetail->id_penerimaan    = $id_header;
                $storePenerimaanDetail->id_barang        = $pembelianDetail->id_barang;
                $storePenerimaanDetail->nama_barang      = $pembelianDetail->nama_barang;
                $storePenerimaanDetail->unit             = $pembelianDetail->unit;
                $storePenerimaanDetail->qty              = $pembelianDetail->qty;
                $storePenerimaanDetail->unit_price       = $pembelianDetail->unit_price;
                $storePenerimaanDetail->total            = $pembelianDetail->total;
                $storePenerimaanDetail->save();
            }

            $updatePembelianHeader = PembelianHeader::find($pembelianHeader->id);
            $updatePembelianHeader->status = 'Diterima';
            $updatePembelianHeader->save();

            return redirect('/penerimaan/edit/'. $id_header)->with('message', 'Data Penerimaan berhasil disimpan!');            
        }
    }

    public function add_detail($id)
    {
        $getPenerimaanHeader = PenerimaanHeader::where('id', $id)->first();
        $getPenerimaanDetail = PenerimaanDetail::where('id_penerimaan', $id)->get();
        $getMasterBarang     = MasterBarang::get();
        $no = 1;

        $commandData = [
            'getPenerimaanHeader'   => $getPenerimaanHeader,
            'getPenerimaanDetail'   => $getPenerimaanDetail,
            'getMasterBarang'       => $getMasterBarang,
            'no'                    => $no,
        ];
        return view('transaksi.penerimaan.add_detail', $commandData);
    }

    public function update(Request $request, $id)
    {
        if($request->surat_tagihan == null && $request->packing_list == null){
            $updatePenerimaanHeader = PenerimaanHeader::find($id);
            $updatePenerimaanHeader->nama_pengirim  = $request->nama_pengirim;
            $updatePenerimaanHeader->hp_pengirim    = $request->hp_pengirim;
            $updatePenerimaanHeader->save();

            return redirect('/penerimaan/edit/'. $id)->with('message', 'Data Penerimaan berhasil diubah!');

        }elseif($request->surat_tagihan != null && $request->packing_list == null){
            $validator = Validator::make($request->all(),[
                'surat_tagihan'  => 'required|max:25000',
            ]);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $getPenerimaanHeader = PenerimaanHeader::find($id);

                File::delete(public_path('uploads/' . $getPenerimaanHeader->surat_tagihan));
                
                if ($file = $request->file('surat_tagihan')) {
                    $filename           = $request->file('surat_tagihan')->getClientOriginalName();
                    $destinationPath    = 'uploads/';
                    $stFile             = date('YmdHis') . "_" . $filename;
                    $file->move($destinationPath, $stFile);
                   
                }
    
                $updatePenerimaanHeader = PenerimaanHeader::find($id);
                $updatePenerimaanHeader->nama_pengirim  = $request->nama_pengirim;
                $updatePenerimaanHeader->hp_pengirim    = $request->hp_pengirim;
                $updatePenerimaanHeader->surat_tagihan  = $stFile;
                $updatePenerimaanHeader->save();
        
                return redirect('/penerimaan/edit/'. $id)->with('message', 'Data Penerimaan berhasil diubah!');
            }
        }elseif($request->surat_tagihan == null && $request->packing_list != null){
            $validator = Validator::make($request->all(),[
                'packing_list'  => 'required|max:25000',
            ]);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $getPenerimaanHeader = PenerimaanHeader::find($id);
                File::delete(public_path('uploads/' . $getPenerimaanHeader->packing_list));
                
                if ($file = $request->file('packing_list')) {
                    $filename           = $request->file('packing_list')->getClientOriginalName();
                    $destinationPath    = 'uploads/';
                    $plFile        = date('YmdHis') . "_" . $filename;
                    
                    $file->move($destinationPath, $plFile);
                   
                }
    
                $updatePenerimaanHeader = PenerimaanHeader::find($id);
                $updatePenerimaanHeader->nama_pengirim  = $request->nama_pengirim;
                $updatePenerimaanHeader->hp_pengirim    = $request->hp_pengirim;
                $updatePenerimaanHeader->packing_list   = $plFile;
                $updatePenerimaanHeader->save();
        
                return redirect('/penerimaan/edit/'. $id)->with('message', 'Data Penerimaan berhasil diubah!');
            }
        }else{
            $validator = Validator::make($request->all(),[
                'surat_tagihan'  => 'required|max:25000',
                'packing_list'  => 'required|max:25000',
            ]);
    
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }else{
                $getPenerimaanHeader = PenerimaanHeader::find($id);
                File::delete(public_path('uploads/' . $getPenerimaanHeader->surat_tagihan));
                File::delete(public_path('uploads/' . $getPenerimaanHeader->packing_list));
                
                if ($file = $request->file('surat_tagihan')) {
                    $filename           = $request->file('surat_tagihan')->getClientOriginalName();
                    $destinationPath    = 'uploads/';
                    $stFile        = date('YmdHis') . "_" . $filename;
                    
                    $file->move($destinationPath, $stFile);
                }

                if ($file = $request->file('packing_list')) {
                    $filename           = $request->file('packing_list')->getClientOriginalName();
                    $destinationPath    = 'uploads/';
                    $plFile        = date('YmdHis') . "_" . $filename;
                    
                    $file->move($destinationPath, $plFile);
                }

                $updatePenerimaanHeader = PenerimaanHeader::find($id);
                $updatePenerimaanHeader->nama_pengirim  = $request->nama_pengirim;
                $updatePenerimaanHeader->hp_pengirim    = $request->hp_pengirim;
                $updatePenerimaanHeader->surat_tagihan  = $stFile;
                $updatePenerimaanHeader->packing_list   = $plFile;
                $updatePenerimaanHeader->save();
        
                return redirect('/penerimaan/edit/'. $id)->with('message', 'Data Penerimaan berhasil diubah!');
            }
        }
    }

    public function update_status(Request $request,$id)
    {
        $updateStatus= PenerimaanHeader::find($id);
        $updateStatus->status = 'Selesai';
        $updateStatus->save(); 
        $no_pembelian       = $updateStatus->no_pembelian;
        $pembelianHeader    = PembelianHeader::where('no_pembelian', $no_pembelian)->first();
        $updatePembelianHeader = PembelianHeader::find($pembelianHeader->id);
        $updatePembelianHeader->status = 'Selesai';
        $updatePembelianHeader->save();

        return redirect('/penerimaan/edit/'. $id)->with('message', 'Status berhasil diupdate!');
    }


    public function delete($id)
    {
        $delPenerimaanHeader    = PenerimaanHeader::delPenerimaanHeader($id);
        $penerimaanDetail       = PenerimaanDetail::where('id_penerimaan', $id)->first();
        $delPenerimaanDetail    = PenerimaanDetail::delPenerimaanDetail($penerimaanDetail->id);

        return redirect('/penerimaan')->with('message', 'Data Pembelian berhasil dihapus!');
    }

}
