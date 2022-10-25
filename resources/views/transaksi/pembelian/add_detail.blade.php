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
                <h1 id="getting-started" class="link-heading">Tambah Pembelian</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                    </div>
                @endif
                <form action="{{url('pembelian/update/'.$getPembelianHeader->id )}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_pembelian" class="form-label">Kode Pembelian</label>
                                <input type="text" class="form-control" id="no_pembelian" name="no_pembelian" value="{{ $getPembelianHeader->no_pembelian }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                                <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="{{ $getPembelianHeader->tanggal_pembelian }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="id_principle" class="form-label">Principle</label>
                                <select name="id_principle" id="id_principle" class="form-control" disabled>
                                    @foreach($getMasterPrincipleAll as $getMasterPrincipleAll)
                                    <option value="{{ $getMasterPrincipleAll->id }}" <?php if($getMasterPrincipleAll->id == $getPembelianHeader->id_principle){echo "selected";}?>>{{ $getMasterPrincipleAll->kode_principle }}-{{ $getMasterPrincipleAll->nama_principle }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="alamat_principle" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat_principle" name="alamat_principle" value="{{ $getPembelianHeader->alamat_principle}}" readonly>{{ $getPembelianHeader->alamat_principle }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="telepon_principle" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="telepon_principle" name="telepon_principle" value="{{ $getPembelianHeader->telepon_principle }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="fax_principle" class="form-label">Fax</label>
                                <input type="text" class="form-control" id="fax_principle" name="fax_principle"  value="{{ $getPembelianHeader->fax_principle }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="term_condition" class="form-label">Term Condition</label>
                                <textarea class="form-control" id="editor" name="term_condition" value="{{ $getPembelianHeader->term_condition }}">{{ $getPembelianHeader->term_condition }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status (AUTO)</label>
                                <input type="text" class="form-control" id="status" name="status" readonly value="{{ $getPembelianHeader->status }}">
                            </div>
                        </div>
                    </div>
                    @if($getPembelianHeader->status == 'Draft')
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
                    @foreach($getPembelianDetail as $getPembelianDetail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $getPembelianDetail->nama_barang}}</td>
                        <td>{{ $getPembelianDetail->unit_price}}</td>
                        <td>{{ $getPembelianDetail->qty}}</td>
                        <td>{{ $getPembelianDetail->total}}</td>
                    </tr>
                    @endforeach
                </table>
                <hr>
                <div class="row">
                    <div class="d-inline">
                        @if($getPembelianHeader->status == 'Draft')
                        <form method="POST" action="/pembelian/update/status/{{ $getPembelianHeader->id }}" onsubmit="return validateFormAjukan()">
                            @csrf
                            @method('PUT')
                            <input type="text" name="status" id="status" value="ajukan" style="display:none;">
                            <input type="submit" class="btn btn-sm btn-success" value="Ajukan Pembelian">
                        </form>
                        @endif
                    </div>
                    <div class="d-inline">
                        <a href="{{url('/pembelian')}}" style="color:#ffffff;" type="cancel" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
            </div>    
        </div>  
    </div>
</div>
@endsection
