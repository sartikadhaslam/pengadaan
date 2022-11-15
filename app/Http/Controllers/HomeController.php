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
            'role' => $role,
            'month' => $month,
            'year' => $year
        ];

        return view('home', $commandData);
    }
}
