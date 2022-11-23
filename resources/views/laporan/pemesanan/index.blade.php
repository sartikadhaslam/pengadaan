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
                        <li><a href="{{url('/laporan-pemesanan')}}"  class="active">Laporan Pemesanan</a></li>
                        <li><a href="{{url('/laporan-pengadaan')}}">Laporan Pengadaan</a></li>
                    </ul>
                    @endif
                </div>
            </div>      
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <div class="no-print">
                    <h1 class="link-heading">Laporan Pemesanan</h1>
                    <hr/>
                    <form class="form-inline" action="" method="get">
                        <label for="tanggal_awal" class="mr-sm-2">Tanggal Akhir:</label>
                        <input type="date" class="form-control mb-2 mr-sm-2" id="email" name="tanggal_awal">
                        <label for="tanggal_akhir" class="mr-sm-2">Tanggal Awal:</label>
                        <input type="date" class="form-control mb-2 mr-sm-2" id="pwd" name="tanggal_akhir">
                        <button type="submit" class="btn btn-primary mb-2">Submit</button>
                    </form>
                </div>
                @if(count($data) > 0)
                <div class="pb-3 pt-5">
                    <h5 class="text-center pb-5">Laporan Pemesanan {{ $tanggal_awal }} s/d {{ $tanggal_akhir }}</h5>
                </div>
                <div class="col-md-6 no-print pl-0">
                    <button class="btn btn-danger ml-0" onclick="window.print()">
                        <i class='fas fa-print'></i> PRINT
                    </button>
                </div>
                <div class="col-md-4 float-right">
                    <input class="form-control no-print" id="myInput" type="text" placeholder="Cari.."><br>
                </div>
                <br>
                <table id="example" class="table" style="width:100%">
                    <thead>
                        <tr>
                            <th scope="col" class="align-middle text-center" width="5%">No</th>
                            <th scope="col" class="align-middle text-center" width="17%">Kode Pemesanan</th>
                            <th scope="col" class="align-middle text-center" width="17%">Tanggal Pemesanan</th>
                            <th scope="col" class="align-middle text-center" width="17%">Tanggal Pengiriman</th>
                            <th scope="col" class="align-middle text-center" width="34%">Customer</th>
                            <th scope="col" class="align-middle text-center" width="10%">Status</th>
                        </tr>
                    </thead>
                    <tbody id="myTable">
                        @foreach($data as $datas)
                            <tr>
                                <td class="text-center">{{ $no++ }}</td>
                                <td>{{ $datas->no_pemesanan }}</td>
                                <td class="text-center">{{ $datas->tanggal_pemesanan }}</td>
                                <td class="text-center">{{ $datas->tanggal }}</td>
                                <td>{{ $datas->nama_customer }}</td>
                                <td>{{ $datas->status }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                @endif
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