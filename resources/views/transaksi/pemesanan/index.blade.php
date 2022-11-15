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
                        <li><a href="{{url('/laporan-pemesanan')}}">Laporan Pengadaan</a></li>
                        <li><a href="{{url('/laporan-pengiriman')}}">Laporan Pengiriman</a></li>
                    </ul>
                    @endif
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
                    </div>
                @endif
                @if($role == 'customer')
                <div class="pb-3">
                    <a href="{{url('/pemesanan/add')}}" class="btn btn-primary text-white" role="button">Tambah</a>
                </div>
                @endif
                <div class="col-md-4 float-right">
                    <input class="form-control" id="myInput" type="text" placeholder="Cari.."><br>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"  width="5%">No</th>
                            <th scope="col"  width="13%">Kode Pemesanan</th>
                            <th scope="col"  width="13%">Tanggal Pemesanan</th>
                            <th scope="col"  width="33%">Customer</th>
                            <th scope="col"  width="10%">Status</th>
                            <th scope="col"  width="22%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($pemesananHeader as $pemesanan)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$pemesanan->no_pemesanan}}</td>
                            <td>{{$pemesanan->tanggal_pemesanan}}</td>
                            <td>{{$pemesanan->customer}}</td>
                            <td>{{$pemesanan->status}}</td>
                            <td>
                            @if($pemesanan->status == 'Draft')
                                <div class="row">
                                    <div class="d-inline">
                                        <a class="btn btn-sm btn-success text-white" href="/pemesanan/edit/{{ $pemesanan->id }}">Edit</a>
                                    </div>
                                    <div class="d-inline">
                                        <form method="POST" action="/pemesanan/delete/{{ $pemesanan->id }}" onsubmit="return validateForm()">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                    <div class="d-inline">
                                    @if($pemesanan->status != 'Draft')
                                        <a class="btn btn-sm btn-secondary text-white" href="/pemesanan/edit/{{ $pemesanan->id }}">View</a>
                                    @endif
                                    </div>
                                    <div class="d-inline">
                                    @if($role != 'customer')
                                    <form method="POST" action="/pemesanan/update/status/{{ $pemesanan->id }}" onsubmit="return validateFormAjukan()">
                                        @csrf
                                        @method('PUT')
                                        <input type="text" name="status" id="status" value="approve" style="display:none;">
                                        @if($pemesanan->status == 'Ajukan Baru')
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
                {!! $pemesananHeader->links() !!}
            </div>    
        </div>  

    </div>
</div>
@endsection
