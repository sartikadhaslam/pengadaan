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
                        <li><a href="{{url('/laporan-pemesanan')}}">Laporan Pengadaan</a></li>
                        <li><a href="{{url('/laporan-pengiriman')}}">Laporan Pengiriman</a></li>
                    </ul>
                    @endif
                </div>
            </div>      
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <h1 id="getting-started" class="link-heading">Tambah Pengiriman</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                    </div>
                @endif
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_pemesanan" class="form-label">Kode Pemesanan</label>
                            <input type="text" class="form-control" id="no_pemesanan" name="no_pemesanan" value="{{$getPengirimanHeader->no_pemesanan}} - {{$getPengirimanHeader->nama_customer}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Pengiriman</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="{{$getPengirimanHeader->tanggal}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="no_surat_jalan" class="form-label">No Surat Jalan (AUTO)</label>
                            <input type="text" class="form-control" id="no_surat_jalan" name="no_surat_jalan" value="{{$getPengirimanHeader->no_surat_jalan}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="no_invoice" class="form-label">No Invoice (AUTO)</label>
                            <input type="text" class="form-control" id="no_invoice" name="no_invoice" value="{{$getPengirimanHeader->no_invoice}}" readonly>
                        </div>  
                        <div class="mb-3">
                            <label for="delivery_to" class="form-label">Delivery To</label>
                            <input type="text" class="form-control" id="delivery_to" name="delivery_to" value="{{$getPengirimanHeader->delivery_to}}" readonly>
                        </div>
                    </div>
                    <div class="col-md-6">  
                        <div class="mb-3">
                            <label for="payment_terms" class="form-label">Payment Terms</label>
                            <input type="text" class="form-control" id="payment_terms" name="payment_terms" value="{{$getPengirimanHeader->payment_terms}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="gross_weight" class="form-label">Gross Weight</label>
                            <input type="text" class="form-control" id="gross_weight" name="gross_weight" value="{{$getPengirimanHeader->gross_weight}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="dimensi" class="form-label">Dimensi</label>
                            <input type="text" class="form-control" id="dimensi" name="dimensi" value="{{$getPengirimanHeader->dimensi}}" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status (AUTO)</label>
                            <input type="text" class="form-control" id="status" name="status" value="{{$getPengirimanHeader->status}}" readonly>
                        </div>
                    </div>
                </div>

                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                    </tr>
                    @foreach($getPengirimanDetail as $getPengirimanDetail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $getPengirimanDetail->nama_barang}}</td>
                        <td>{{ number_format($getPengirimanDetail->unit_price) }}</td>
                        <td>{{ $getPengirimanDetail->qty}}</td>
                        <td>{{ number_format($getPengirimanDetail->total) }}</td>
                    </tr>
                    @endforeach
                </table>
                <hr>
                <div class="row">
                    <div class="d-inline">
                        @if($getPengirimanHeader->status == 'Dikirim')
                        <form method="POST" action="/pengiriman/update/status/{{ $getPengirimanHeader->id }}" onsubmit="return validateFormAjukan()">
                            @csrf
                            @method('PUT')
                            <input type="submit" class="btn btn-sm btn-success" value="Update Selesai">
                        </form>
                        @endif
                    </div>
                    <div class="d-inline">
                        <a href="{{url('/pengiriman')}}" style="color:#ffffff;" type="cancel" class="btn btn-secondary">Kembali</a>
                    </div>
                    <div class="d-inline">
                        <a href="{{url('/pembelian/sj/'. $getPengirimanHeader->id)}}" target="_blank" style="color:#ffffff;" type="cancel" class="btn btn-danger"><i class="bi bi-printer"></i> Surat Jalan</a>
                    </div>
                    <div class="d-inline">
                        <a href="{{url('/pembelian/in/'. $getPengirimanHeader->id)}}" target="_blank" style="color:#ffffff;" type="cancel" class="btn btn-danger"><i class="bi bi-printer"></i> Invoice</a>
                    </div>
                </div>
            </div>    
        </div>  
    </div>
</div>
@endsection
