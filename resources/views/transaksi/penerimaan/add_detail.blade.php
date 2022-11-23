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
                <h1 id="getting-started" class="link-heading">Tambah Penerimaan</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                    </div>
                @endif
                <form action="{{url('penerimaan/update/'.$getPenerimaanHeader->id )}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_pembelian" class="form-label">Kode Pembelian</label>
                                <input type="text" class="form-control" id="no_pembelian" name="no_pembelian" value="{{ $getPenerimaanHeader->no_pembelian }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_penerimaan" class="form-label">Tanggal Penerimaan</label>
                                <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan" value="{{ $getPenerimaanHeader->tanggal_penerimaan }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="surat_tagihan" class="form-label">Surat Tagihan</label><br>
                                <input type="file" id="surat_tagihan" name="surat_tagihan" accept=".pdf,.png,.jpg,.jpeg"><br><br>
                                <div id="st_old">
                                    <a href="{{asset('/uploads/'. $getPenerimaanHeader->surat_tagihan)}}" target="_blank"><span><i class="bi bi-paperclip"></i>{{ $getPenerimaanHeader->surat_tagihan }}</span></a>
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="packing_list" class="form-label">Packing List</label><br>
                                <input type="file" id="packing_list" name="packing_list" accept=".pdf,.png,.jpg,.jpeg"><br><br>
                                <div id="pl_old">
                                    <a href="{{asset('/uploads/'. $getPenerimaanHeader->packing_list)}}" target="_blank"><span><i class="bi bi-paperclip"></i>{{ $getPenerimaanHeader->packing_list }}</span></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
                                <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" value="{{ $getPenerimaanHeader->nama_pengirim }}">
                            </div>
                            <div class="mb-3">
                                <label for="hp_pengirim" class="form-label">HP Pengirim</label>
                                <input type="text" class="form-control" id="hp_pengirim" name="hp_pengirim" value="{{ $getPenerimaanHeader->hp_pengirim }}">
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status (AUTO)</label>
                                <input type="text" class="form-control" id="status" name="status" readonly value="{{ $getPenerimaanHeader->status }}">
                            </div>
                        </div>
                    </div>
                    @if($getPenerimaanHeader->status == 'Diterima')
                    <br>
                    <button class="btn btn-sm btn-success ml-0">Update Header</button>
                    @endif
                </form>
                <br>
                <br>
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                    @foreach($getPenerimaanDetail as $getPenerimaanDetail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $getPenerimaanDetail->nama_barang}}</td>
                        <td>{{ number_format($getPenerimaanDetail->unit_price)}}</td>
                        <td>{{ $getPenerimaanDetail->qty}}</td>
                        <td>{{ number_format($getPenerimaanDetail->total) }}</td>
                    </tr>
                    @endforeach
                </table>
                <hr>
                <div class="row">
                    <div class="d-inline">
                        @if($getPenerimaanHeader->status == 'Diterima')
                        <form method="POST" action="/penerimaan/update/status/{{ $getPenerimaanHeader->id }}" onsubmit="return validateFormAjukan()">
                            @csrf
                            @method('PUT')
                            <input type="submit" class="btn btn-sm btn-success" value="Update Selesai">
                        </form>
                        @endif
                    </div>
                    <div class="d-inline">
                        <a href="{{url('/penerimaan')}}" style="color:#ffffff;" type="cancel" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>    
        </div>  
    </div>
</div>
@endsection
