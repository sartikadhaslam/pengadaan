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
                        <li><a href="{{url('/laporan-pemesanan')}}">Laporan Pengadaan</a></li>
                        <li><a href="{{url('/laporan-pengiriman')}}">Laporan Pengiriman</a></li>
                    </ul>
                    @endif
                </div>
            </div>      
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <h1 class="link-heading">Master Barang</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                    </div>
                @endif
                <div class="pb-3">
                    <a href="{{url('/master-barang/add')}}" class="btn btn-primary text-white" role="button">Tambah</a>
                </div>
                <div class="col-md-4 float-right">
                    <input class="form-control" id="myInput" type="text" placeholder="Cari.."><br>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col" class="align-middle" width="5%">No</th>
                            <th scope="col" class="align-middle" width="38%">Nama Barang</th>
                            <th scope="col" class="align-middle" width="5%">Unit</th>
                            <th scope="col" class="align-middle" width="16%">Harga Beli (USD)</th>
                            <th scope="col" class="align-middle" width="16%">Harga Jual (IDR)</th>
                            <th scope="col" class="align-middle" width="20%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($getMasterBarang as $masterBarang)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{ $masterBarang->nama_barang }}</td>
                            <td>{{ $masterBarang->unit }}</td>
                            <td>{{ number_format($masterBarang->harga_beli) }}</td>
                            <td>{{ number_format($masterBarang->harga_jual) }}</td>
                            <td>
                                <div class="row">
                                    <div class="d-inline">
                                        <a class="btn btn-sm btn-success text-white" href="/master-barang/edit/{{ $masterBarang->id }}">Edit</a>
                                    </div>
                                    <div class="d-inline">
                                        <form method="POST" action="/master-barang/delete/{{ $masterBarang->id }}" onsubmit="return validateForm()">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
                                        </form>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $getMasterBarang->links() !!}
            </div>    
        </div>  
    </div>
</div>
@endsection
