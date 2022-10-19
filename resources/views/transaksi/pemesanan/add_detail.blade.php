@extends('layouts.app')

@section('content')
<div class="">
    <div class="documentation-container">
        <div class="docs-sidebar">
            <div class="docs-content-area">
                <div class="docs-list">
                    <h5>DASHBOARD</h5>
                    <ul>
                        <li><a href="./index.html">Dashboard</a></li>
                    </ul>
                    <h5>MASTER</h5>
                    <ul>
                        <li><a href="{{url('/master-barang')}}">Master Barang</a></li>
                        <li><a href="{{url('/master-customer')}}">Master Customer</a></li>
                        <li><a href="{{url('/master-principle')}}">Master Principle</a></li>
                    </ul>
                    
                    <h5>TRANSAKSI</h5>
                    
                    <ul>
                        <li><a href="{{url('/pemesanan')}}">Pemesanan oleh Customer</a></li>
                        <li><a href="{{url('/pembelian')}}">Pembelian ke Principle</a></li>
                        <li><a href="{{url('/penerimaan')}}">Penerimaan dari Principle</a></li>
                        <li><a href="{{url('/pengiriman')}}">Pengiriman ke Customer</a></li>
                    </ul>
                    
                    <h5>LAPORAN</h5>

                    <ul>
                        <li><a href="{{url('/laporan-pemesanan')}}">Laporan Pengadaan</a></li>
                        <li><a href="{{url('/laporan-pengiriman')}}">Laporan Pengiriman</a></li>
                    </ul>
                </div>
            </div>      
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <h1 id="getting-started" class="link-heading">Tambah Pemesanan</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                    </div>
                @endif
                <form action="{{url('pemesanan/update/'.$getPemesananHeader->id )}}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="no_pemesanan" class="form-label">Kode Pemesanan</label>
                                <input type="text" class="form-control" id="no_pemesanan" name="no_pemesanan" value="{{ $getPemesananHeader->no_pemesanan }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="tanggal_pemesanan" class="form-label">Tanggal Pemesanan</label>
                                <input type="date" class="form-control" id="tanggal_pemesanan" name="tanggal_pemesanan" value="{{ $getPemesananHeader->tanggal_pemesanan }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="nama_customer" class="form-label">Customer</label>
                                <input type="text" class="form-control" id="id_customer" name="id_customer" value="{{ $getPemesananHeader->id_customer }}" style="display:none;">
                                <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="{{ $getPemesananHeader->id_customer }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="alamat_customer" class="form-label">Alamat</label>
                                <textarea class="form-control" id="alamat_customer" name="alamat_customer" value="{{ $getPemesananHeader->alamat_customer }}" readonly>{{ $getPemesananHeader->alamat_customer }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="telepon_customer" class="form-label">Telepon</label>
                                <input type="text" class="form-control" id="telepon_customer" name="telepon_customer" value="{{ $getPemesananHeader->telepon_customer }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="fax_customer" class="form-label">Fax</label>
                                <input type="text" class="form-control" id="fax_customer" name="fax_customer" value="{{ $getPemesananHeader->fax_customer }}" readonly>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="ship_to" class="form-label">Ship To</label>
                                <input type="text" class="form-control" id="ship_to" name="ship_to" value="{{ $getPemesananHeader->ship_to }}">
                            </div>
                            <div class="mb-3">
                                <label for="delivery_deadline" class="form-label">Delivery Deadline</label>
                                <input type="date" class="form-control" id="delivery_deadline" name="delivery_deadline" value="{{ $getPemesananHeader->delivery_deadline }}">
                            </div>
                            <div class="mb-3">
                                <label for="payment_terms" class="form-label">Payment Terms</label>
                                <input type="text" class="form-control" id="payment_terms" name="payment_terms" value="{{ $getPemesananHeader->payment_terms }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="remark" class="form-label">Remark</label>
                                <textarea class="form-control" id="remark" name="remark" value="{{ $getPemesananHeader->remark }}">{{ $getPemesananHeader->remark }}</textarea>
                            </div>
                            <div class="mb-3">
                                <label for="status" class="form-label">Status</label>
                                <input type="text" class="form-control" id="status" name="status" value="{{ $getPemesananHeader->status }}" readonly>
                            </div>
                            <div class="mb-3">
                                <label for="file" class="form-label">File</label><br>
                                <input type="file" id="file" name="file" accept=".pdf,.png,.jpg,.jpeg"><br><br>
                                <div id="file_old">
                                    <a href="{{asset('/uploads/'. $getPemesananHeader->file)}}" target="_blank"><span><i class="bi bi-paperclip"></i>{{ $getPemesananHeader->file }}</span></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($getPemesananHeader->status == 'Draft')
                    <button class="btn btn-sm btn-success ml-0">Update Header</button>
                    @endif
                </form>
                @if($getPemesananHeader->status == 'Draft')
                <hr>
                <button type="button" data-toggle="modal" data-target="#myModal" class="btn btn-sm btn-primary" style="color:#ffffff;margin-left:0px">Tambah Barang</button>
                <br>
                <br>
                @endif
                <table class="table">
                    <tr>
                        <th>No</th>
                        <th>Barang</th>
                        <th>Harga</th>
                        <th>Qty</th>
                        <th>Total</th>
                        @if($getPemesananHeader->status == 'Draft')
                        <th>Action</th>
                        @endif
                    </tr>
                    @foreach($getPemesananDetail as $getPemesananDetail)
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $getPemesananDetail->nama_barang}}</td>
                        <td>{{ $getPemesananDetail->unit_price}}</td>
                        <td>{{ $getPemesananDetail->qty}}</td>
                        <td>{{ $getPemesananDetail->total}}</td>
                        @if($getPemesananHeader->status == 'Draft')
                        <td>
                            <div class="d-inline">
                                <form method="POST" action="/pemesanan/detail/delete/{{ $getPemesananDetail->id }}" onsubmit="return validateForm()">
                                    @csrf
                                    @method('DELETE')
                                    <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
                                </form>
                            </div>
                        </td>
                        @endif
                    </tr>
                    @endforeach
                </table>
                <hr>
                <div class="row">
                    <div class="d-inline">
                        @if($getPemesananHeader->status == 'Draft')
                        <form method="POST" action="/pemesanan/update/status/{{ $getPemesananHeader->id }}" onsubmit="return validateFormAjukan()">
                            @csrf
                            @method('PUT')
                            <input type="text" name="status" id="status" value="ajukan" style="display:none;">
                            <input type="submit" class="btn btn-sm btn-success" value="Ajukan PO">
                        </form>
                        @endif
                    </div>
                    <div class="d-inline">
                        <a href="{{url('/pemesanan')}}" style="color:#ffffff;" type="cancel" class="btn btn-secondary">Kembali</a>
                    </div>
                </div>
                 <!-- The Modal -->
                <div class="modal fade" id="myModal">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                        
                            <!-- Modal Header -->
                            <div class="modal-header">
                            <h5 class="modal-title">Tambah Barang</h5>
                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                            </div>
                            
                            <!-- Modal body -->
                            <div class="modal-body">
                            <form action="{{url('/pemesanan/store/'. $getPemesananHeader->id)}}" method="post">
                            @csrf
                                <div class="mb-3">
                                    <label for="id_barang" class="form-label">Barang</label>
                                    <select name="id_barang" id="id_barang"  class="form-control">
                                        <option>--Pilih Barang--</option>
                                        @foreach($getMasterBarang as $getMasterBarang)
                                        <option value="{{ $getMasterBarang->id }}">{{ $getMasterBarang->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="qty" class="form-label">Qty</label>
                                    <input type="text" id="id_pemesanan" name="id_pemesanan" value="{{ $getPemesananHeader->id }}" style="display:none;">
                                    <input type="number" class="form-control" id="qty" name="qty">
                                </div>
                                
                            </div>
                            
                            <!-- Modal footer -->
                            <div class="modal-footer">
                            <button type="submit" class="btn btn-success">Simpan</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>    
        </div>  
    </div>
</div>
@endsection
