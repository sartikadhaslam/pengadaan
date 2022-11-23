<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PemesananHeader;
use App\Models\PembelianHeader;
use App\Models\MasterCustomer;
use App\Models\MasterPrinciple;
use Auth;
use DB;

class HomeController extends Controller
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
    public function index()
    {
        $role = Auth::user()->role;
        $pemesananBaru = [];
        $pemesanan = [];
        $pemesananKiri = [];
        $pembelianBaru = [];
        $pembelianAppr = [];
        $pembelian = [];
        $pembelianKiri = [];

        if($role == 'pengadaan'){
            $pemesananBaru = PemesananHeader::where('status', 'Ajukan Baru')->get();
            $pemesananKiri = PemesananHeader::where('status', 'Proses')->get();
            $pemesanan = PemesananHeader::select('tanggal_pemesanan', DB::RAW('COUNT(id) as id'))->groupBy('tanggal_pemesanan')->get();
        }elseif($role == 'customer'){
            $pembelian = PembelianHeader::select('tanggal_pembelian', DB::RAW('COUNT(id) as id'))->groupBy('tanggal_pembelian')->get();
            $getMasterCustomer  = MasterCustomer::where('email', Auth::user()->email)->first();
            $pemesananBaru = PemesananHeader::where([
                ['status', 'Ajukan Baru'],
                ['id_customer', $getMasterCustomer->id]
            ])->get();
            $pemesananKiri = PemesananHeader::where([
                ['status', 'Proses'],
                ['id_customer', $getMasterCustomer->id]
            ])->get();
            $pemesanan = PemesananHeader::select('tanggal_pemesanan', DB::RAW('COUNT(id) as id'))->where('id_customer', $getMasterCustomer->id)->groupBy('tanggal_pemesanan')->get();
        }

        if($role == 'pengadaan'){
            $pembelianBaru = PembelianHeader::where('status', 'Ajukan Baru')->get();
            $pembelianAppr = PembelianHeader::where('status', 'Approve')->get();
            $pembelian = PembelianHeader::select('tanggal_pembelian', DB::RAW('COUNT(id) as id'))->groupBy('tanggal_pembelian')->get();
        }elseif($role == 'principle'){
            $pemesanan = PemesananHeader::select('tanggal_pemesanan', DB::RAW('COUNT(id) as id'))->groupBy('tanggal_pemesanan')->get();
            $getMasterPrinciple = MasterPrinciple::where('email', Auth::user()->email)->first();
            $pembelianBaru = PembelianHeader::where([
                ['status', 'Ajukan Baru'],
                ['id_principle', $getMasterPrinciple->id]
            ])->get();
            $pembelianAppr = PembelianHeader::where([
                ['status', 'Approve'],
                ['id_principle', $getMasterPrinciple->id]
            ])->get();
            $pembelian = PembelianHeader::select('tanggal_pembelian', DB::RAW('COUNT(id) as id'))->where('id_principle', $getMasterPrinciple->id)->groupBy('tanggal_pembelian')->get();
        }

        $month = date('M');

        $year = date('Y');

        $commandData = [
            'pemesananBaru' => $pemesananBaru,
            'pembelianBaru' => $pembelianBaru,
            'pembelianAppr' => $pembelianAppr,
            'pemesananKiri' => $pemesananKiri,
            'pembelian'     => $pembelian,
            'pemesanan'     => $pemesanan,
            'role'          => $role,
            'month'         => $month,
            'year'          => $year
        ];

        return view('home', $commandData);
    }

    public function laporan_pemesanan(Request $request){
        $data = [];
        $no = 1;
        
        if($request->tanggal_awal != null && $request->tanggal_akhir != null){
            $data = PemesananHeader::select('pemesanan_header.tanggal_pemesanan', 'pengiriman_header.tanggal', 'pemesanan_header.no_pemesanan', 'master_customer.nama_customer', 'pemesanan_header.status')
            ->join('master_customer', 'master_customer.id', 'pemesanan_header.id_customer')
            ->leftjoin('pengiriman_header', 'pengiriman_header.no_pemesanan', 'pemesanan_header.no_pemesanan')
            ->whereBetween('pemesanan_header.tanggal_pemesanan', [$request->tanggal_awal, $request->tanggal_akhir])
            ->orderBy('pemesanan_header.tanggal_pemesanan', 'asc')
            ->get();
        }
        $commandData = [
            'data'          => $data,
            'no'            => $no,
            'tanggal_awal'  => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir
        ];

        return view('laporan.pemesanan.index', $commandData);
    }

    public function laporan_pengadaan(Request $request){
        $data = [];
        $no = 1;
        
        if($request->tanggal_awal != null && $request->tanggal_akhir != null){
            $data = PembelianHeader::select('pembelian_header.tanggal_pembelian', 'penerimaan_header.tanggal_penerimaan', 'pembelian_header.no_pembelian', 'master_principle.nama_principle', 'pembelian_header.status')
            ->join('master_principle', 'master_principle.id', 'pembelian_header.id_principle')
            ->leftjoin('penerimaan_header', 'penerimaan_header.no_pembelian', 'pembelian_header.no_pembelian')
            ->whereBetween('pembelian_header.tanggal_pembelian', [$request->tanggal_awal, $request->tanggal_akhir])
            ->orderBy('pembelian_header.tanggal_pembelian', 'asc')
            ->get();
        }
        $commandData = [
            'data'          => $data,
            'no'            => $no,
            'tanggal_awal'  => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir
        ];

        return view('laporan.pengadaan.index', $commandData);
    }
}
