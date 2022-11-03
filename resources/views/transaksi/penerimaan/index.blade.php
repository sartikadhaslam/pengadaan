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
                <h1 class="link-heading">Penerimaan dari Principle</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                    </div>
                @endif
                <div class="pb-3">
                    <a href="{{url('/penerimaan/add')}}" class="btn btn-primary text-white" role="button">Tambah</a>
                </div>
                <div class="col-md-4 float-right">
                    <input class="form-control" id="myInput" type="text" placeholder="Cari.."><br>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="align-middle"  width="5%">No</th>
                            <th scope="col" class="align-middle"  width="15%">Kode Pembelian</th>
                            <th scope="col" class="align-middle"  width="15%">Tanggal Penerimaan</th>
                            <th scope="col" class="align-middle"  width="35%">Principle</th>
                            <th scope="col" class="align-middle"  width="10%">Status</th>
                            <th scope="col" class="align-middle"  width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($penerimaanHeader as $penerimaan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$penerimaan->no_pembelian}}</td>
                            <td>{{$penerimaan->tanggal_penerimaan}}</td>
                            <td>{{$penerimaan->nama_principle}}</td>
                            <td>{{$penerimaan->status}}</td>
                            <td>
                            @if($penerimaan->status == 'Diterima')
                                <div class="row">
                                    <div class="d-inline">
                                        <a class="btn btn-sm btn-success text-white" href="/penerimaan/edit/{{ $penerimaan->id }}">Edit</a>
                                    </div>
                                    <div class="d-inline">
                                        <form method="POST" action="/penerimaan/delete/{{ $penerimaan->id }}" onsubmit="return validateForm()">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
                                        </form>
                                    </div>
                                </div>
                            @endif
                            @if($penerimaan->status == 'Selesai')
                            <div class="row">
                                <div class="d-inline">
                                    <a class="btn btn-sm btn-secondary text-white" href="/penerimaan/edit/{{ $penerimaan->id }}">View</a>
                                </div>
                            </div>
                            @endif
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
