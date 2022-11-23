@extends('layouts.app')

@section('content')
<div class="">
    <div class="documentation-container">
        <div class="docs-sidebar">

            <div class="docs-content-area">
                <div class="docs-list">
                    <h5>DASHBOARD</h5>
                    <ul>
                        <li><a href="{{url('/')}}">Dashboard</a></li>
                    </ul>
                    @if(Auth::user()->role == 'pengadaan')
                    <h5>MASTER</h5>
                    <ul>
                        <li><a href="{{url('/master-barang')}}" class="active">Master Barang</a></li>
                        <li><a href="{{url('/master-customer')}}">Master Customer</a></li>
                        <li><a href="{{url('/master-principle')}}">Master Principle</a></li>
                        <li><a href="{{url('/master-user')}}">Master User</a></li>
                    </ul>
                    @endif
                    <h5>TRANSAKSI</h5>
                    
                    <ul>
                    @if(Auth::user()->role != 'principle')
                        <li><a href="{{url('/pemesanan')}}">Pemesanan oleh Customer</a></li>
                        <li><a href="{{url('/pengiriman')}}">Pengiriman ke Customer</a></li>
                    @endif
                    @if(Auth::user()->role != 'customer')
                        <li><a href="{{url('/pembelian')}}">Pembelian ke Principle</a></li>
                        <li><a href="{{url('/penerimaan')}}">Penerimaan dari Principle</a></li>
                    @endif
                    </ul>
                    @if(Auth::user()->role == 'pengadaan')
                    <h5>LAPORAN</h5>

                    <ul>
                        <li><a href="{{url('/laporan-pemesanan')}}">Laporan Pemesanan</a></li>
                        <li><a href="{{url('/laporan-pengadaan')}}">Laporan Pengadaan</a></li>
                    </ul>
                    @endif
                </div>
            </div>      
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <h1 id="getting-started" class="link-heading">Tambah Master Barang</h1>
                <hr/>
                <form action="{{url('master-barang/store')}}" method="post">
                @csrf
                    <div class="mb-3">
                        <label for="kode_barang" class="form-label">Kode Barang</label>
                        <input type="text" class="form-control" id="kode_barang" name="kode_barang" maxlength="12" size="12">
                    </div>
                    <div class="mb-3">
                        <label for="nama_barang" class="form-label">Nama Barang</label>
                        <textarea class="form-control" id="nama_barang" name="nama_barang"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="unit" class="form-label">Unit</label>
                        <input type="text" class="form-control" id="unit" name="unit">
                    </div>
                    <div class="mb-3">
                        <label for="harga_beli" class="form-label">Harga Beli (USD)</label>
                        <input type="text" class="form-control" id="harga_beli" name="harga_beli">
                    </div>
                    <div class="mb-3">
                        <label for="harga_jual" class="form-label">Harga Jual (IDR)</label>
                        <input type="text" class="form-control" id="harga_jual" name="harga_jual">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="cancel" class="btn btn-danger">Batal</button>
                </form>
            </div>    
        </div>  

    </div>
</div>
@endsection
