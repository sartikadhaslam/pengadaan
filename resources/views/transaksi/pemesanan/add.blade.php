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
                <h1 id="getting-started" class="link-heading">Tambah Pemesanan</h1>
                <hr/>
                @if ($errors->any())
                    <div class="alert alert-success alert-dismissible mt-3" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{url('pemesanan/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_pemesanan" class="form-label">Kode Pemesanan</label>
                            <input type="text" class="form-control" id="no_pemesanan" name="no_pemesanan">
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                            <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="nama_customer" class="form-label">Customer</label>
                            <input type="text" class="form-control" id="id_customer" name="id_customer" value="{{$getMasterCustomer->id}}" style="display:none;">
                            <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="{{$getMasterCustomer->nama_customer}}">
                        </div>
                        <div class="mb-3">
                            <label for="alamat_customer" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat_customer" name="alamat_customer" value="{{$getMasterCustomer->alamat}}">{{$getMasterCustomer->alamat}}</textarea>
                        </div>
                        <div class="mb-3">
                            <label for="telepon_customer" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon_customer" name="telepon_customer" value="{{$getMasterCustomer->no_telp}}">
                        </div>
                        <div class="mb-3">
                            <label for="fax_customer" class="form-label">Fax</label>
                            <input type="text" class="form-control" id="fax_customer" name="fax_customer" value="{{$getMasterCustomer->fax}}">
                        </div>
                        <div class="mb-3">
                            <label for="ship_to" class="form-label">Ship To</label>
                            <input type="text" class="form-control" id="ship_to" name="ship_to" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="delivery_deadline" class="form-label">Delivery Deadline</label>
                            <input type="date" class="form-control" id="delivery_deadline" name="delivery_deadline ">
                        </div>
                        <div class="mb-3">
                            <label for="payment_terms" class="form-label">Payment Terms</label>
                            <input type="text" class="form-control" id="payment_terms" name="payment_terms" value="{{$getMasterCustomer->payment_terms}}">
                        </div>
                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" id="editor" name="remark" height="200px"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status (AUTO)</label>
                            <input type="text" class="form-control" id="status" name="status" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">File</label><br>
                            <input type="file" id="file" name="file" accept=".pdf,.png,.jpg,.jpeg">
                        </div>
                    </div>
                </div>
                <br>
                    <button type="submit" class="btn btn-success ml-0">Simpan</button>
                    <a href="{{url('/pemesanan')}}" style="color:#ffffff;" type="cancel" class="btn btn-secondary">Kembali</a>
                </form>
            </div>    
        </div>  

    </div>
</div>
@endsection
