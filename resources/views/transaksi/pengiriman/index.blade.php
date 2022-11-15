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
                <h1 class="link-heading">Pengiriman ke Customer</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                    </div>
                @endif
                @if($role == 'pengadaan')
                <div class="pb-3">
                    <a href="{{url('/pengiriman/add')}}" class="btn btn-primary text-white" role="button">Tambah</a>
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
                            <th scope="col"  width="13%">Tanggal Pengiriman </th>
                            <th scope="col"  width="33%">Customer</th>
                            <th scope="col"  width="10%">Status</th>
                            <th scope="col"  width="22%">Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($pengirimanHeader as $pengiriman)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$pengiriman->no_pemesanan}}</td>
                            <td>{{$pengiriman->tanggal}}</td>
                            <td>{{$pengiriman->nama_customer}}</td>
                            <td>{{$pengiriman->status}}</td>
                            <td>
                            @if($pengiriman->status == 'Dikirim')
                                <div class="row">
                                    <div class="d-inline">
                                        <a class="btn btn-sm btn-success text-white" href="/pengiriman/edit/{{ $pengiriman->id }}">Edit</a>
                                    </div>
                                    <div class="d-inline">
                                        <form method="POST" action="/pengiriman/delete/{{ $pengiriman->id }}" onsubmit="return validateForm()">
                                            @csrf
                                            @method('DELETE')
                                            <input type="submit" class="btn btn-sm btn-danger" value="Hapus">
                                        </form>
                                    </div>
                                </div>
                            @endif
                            <div class="row">
                                    <div class="d-inline">
                                    @if($pengiriman->status == 'Selesai')
                                        <a class="btn btn-sm btn-secondary text-white" href="/pengiriman/edit/{{ $pengiriman->id }}">View</a>
                                    @endif
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                {!! $pengirimanHeader->links() !!}
            </div>    
        </div>  

    </div>
</div>
@endsection
