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
                        <li><a href="{{url('/master-customer')}}" class="active">Master Customer</a></li>
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
                <h1 class="link-heading">Master Customer</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                    </div>
                @endif
                <div class="pb-3">
                    <a href="{{url('/master-customer/add')}}" class="btn btn-primary text-white" role="button">Tambah</a>
                </div>
                <div class="col-md-4 float-right">
                    <input class="form-control" id="myInput" type="text" placeholder="Cari.."><br>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"  class="align-middle" >No</th>
                            <th scope="col"  class="align-middle" >Nama Customer</th>
                            <th scope="col"  class="align-middle" >No Telepon</th>
                            <th scope="col"  class="align-middle" >PIC</th>
                            <th scope="col"  class="align-middle" >Payment Terms</th>
                            <th scope="col"  class="align-middle" >Action</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($getMasterCustomer as $masterCustomer)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$masterCustomer->nama_customer}}</td>
                            <td>{{$masterCustomer->no_telp}}</td>
                            <td>{{$masterCustomer->nama_pic}}</td>
                            <td>{{$masterCustomer->payment_terms}}</td>
                            <td>
                                <div class="row">
                                    <div class="d-inline">
                                        <a class="btn btn-sm btn-success text-white" href="/master-customer/edit/{{ $masterCustomer->id }}">Edit</a>
                                    </div>
                                    <div class="d-inline">
                                        <form method="POST" action="/master-customer/delete/{{ $masterCustomer->id }}" onsubmit="return validateForm()">
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
                {!! $getMasterCustomer->links() !!}
            </div>    
        </div>  

    </div>
</div>
<script type="text/javascript">
    $("#myInput").on("keyup", function() {
        var value = $(this).val().toLowerCase();
        $("#myTable tr").filter(function() {
        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
        });
    });
</script>
@endsection
