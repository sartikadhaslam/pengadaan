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
                <h1 class="link-heading">Pemesanan oleh Customer</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="pb-3">
                    <a href="{{url('/pemesanan/add')}}" class="btn btn-primary text-white" role="button">Tambah</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Kode Pemesanan</th>
                            <th scope="col">Tanggal Pemesanan</th>
                            <th scope="col">Customer</th>
                            <th scope="col">Status</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pemesananHeader as $pemesananHeader)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$pemesananHeader->no_pemesanan}}</td>
                            <td>{{$pemesananHeader->tanggal_pemesanan}}</td>
                            <td>{{$pemesananHeader->customer}}</td>
                            <td>{{$pemesananHeader->status}}</td>
                            <td>
                            @if($pemesananHeader->status == 'Draft')
                                <div class="row">
                                    <div class="d-inline">
                                        <a class="btn btn-sm btn-success text-white" href="/pemesanan/edit/{{ $pemesananHeader->id }}">Edit</a>
                                    </div>
                                    <div class="d-inline">
                                        <form method="POST" action="/pemesanan/delete/{{ $pemesananHeader->id }}" onsubmit="return validateForm()">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                    <div class="d-inline">
                                    @if($pemesananHeader->status != 'Draft')
                                        <a class="btn btn-sm btn-secondary text-white" href="/pemesanan/edit/{{ $pemesananHeader->id }}">View</a>
                                    @endif
                                    </div>
                                    <div class="d-inline">
                                    @if($role != 'customer')
                                    <form method="POST" action="/pemesanan/update/status/{{ $pemesananHeader->id }}" onsubmit="return validateFormAjukan()">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="status" id="status" value="approve" style="display:none;">
                                        @if($pemesananHeader->status == 'Ajukan Baru')
                                        <input type="submit" class="btn btn-sm btn-success" value="Approve">
                                        @endif
                                    </form>
                                    @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>    
        </div>  

    </div>
</div>
@endsection
