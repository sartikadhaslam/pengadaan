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
                        <li><a href="{{url('/master-barang')}}">Master Barang</a></li>
                        <li><a href="{{url('/master-customer')}}">Master Customer</a></li>
                        <li><a href="{{url('/master-principle')}}" class="active">Master Principle</a></li>
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
                <h1 id="getting-started" class="link-heading">Tambah Master Principle</h1>
                <hr/>
                <form action="{{url('master-principle/store')}}" method="post">
                @csrf
                    <div class="mb-3">
                        <label for="kode_principle" class="form-label">Kode Principle</label>
                        <input type="text" class="form-control" id="kode_principle" name="kode_principle">
                    </div>
                    <div class="mb-3">
                        <label for="nama_principle" class="form-label">Nama Principle</label>
                        <input type="text" class="form-control" id="nama_principle" name="nama_principle">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" maxlength="13" >
                    </div>
                    <div class="mb-3">
                        <label for="fax" class="form-label">Nomor Fax</label>
                        <input type="text" class="form-control" id="fax" name="fax">
                    </div>
                    <div class="mb-3">
                        <label for="nama_pic" class="form-label">Nama PIC</label>
                        <input type="text" class="form-control" id="nama_pic" name="nama_pic">
                    </div>
                    <div class="mb-3">
                        <label for="jabatan_pic" class="form-label">Jabatan PIC</label>
                        <input type="text" class="form-control" id="jabatan_pic" name="jabatan_pic">
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="cancel" class="btn btn-danger">Batal</button>
                </form>
            </div>    
        </div>  

    </div>
</div>
@endsection
