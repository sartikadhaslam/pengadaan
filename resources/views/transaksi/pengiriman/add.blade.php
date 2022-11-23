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
                        <li><a href="{{url('/laporan-pemesanan')}}">Laporan Pemesanan</a></li>
                        <li><a href="{{url('/laporan-pengadaan')}}">Laporan Pengadaan</a></li>
                    </ul>
                    @endif
                </div>
            </div>      
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <h1 id="getting-started" class="link-heading">Tambah Pengiriman</h1>
                <hr/>
                @if ($errors->any())
                    <div class="alert alert-success alert-dismissible mt-3" role="alert">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="{{url('pengiriman/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_pemesanan" class="form-label">Kode Pemesanan</label>
                            <select name="no_pemesanan" id="no_pemesanan" class="form-control" >
                                <option>--Pilih No Pemesanan --</option>
                                @foreach($pemesananHeader as $pemesananHeader)
                                <option value="{{$pemesananHeader->no_pemesanan}}">{{$pemesananHeader->no_pemesanan}} - {{$pemesananHeader->customer}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal" class="form-label">Tanggal Pengiriman</label>
                            <input type="date" class="form-control" id="tanggal" name="tanggal" value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="no_surat_jalan" class="form-label">No Surat Jalan (AUTO)</label>
                            <input type="text" class="form-control" id="no_surat_jalan" name="no_surat_jalan" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="no_invoice" class="form-label">No Invoice (AUTO)</label>
                            <input type="text" class="form-control" id="no_invoice" name="no_invoice" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="delivery_to" class="form-label">Delivery To</label>
                            <input type="text" class="form-control" id="delivery_to" name="delivery_to" required>
                        </div>
                    </div>
                    <div class="col-md-6">   
                        <div class="mb-3">
                            <label for="payment_terms" class="form-label">Payment Terms</label>
                            <input type="text" class="form-control" id="payment_terms" name="payment_terms" required>
                        </div>
                        <div class="mb-3">
                            <label for="gross_weight" class="form-label">Gross Weight</label>
                            <input type="text" class="form-control" id="gross_weight" name="gross_weight" required>
                        </div>
                        <div class="mb-3">
                            <label for="dimensi" class="form-label">Dimensi</label>
                            <input type="text" class="form-control" id="dimensi" name="dimensi" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status (AUTO)</label>
                            <input type="text" class="form-control" id="status" name="status" readonly>
                        </div>
                    </div>
                </div>
                <br>
                    <button type="submit" class="btn btn-success ml-0">Simpan</button>
                    <a href="{{url('/pengiriman')}}" style="color:#ffffff;" type="cancel" class="btn btn-secondary">Kembali</a>
                </form>
            </div>    
        </div>  

    </div>
</div>
<script type="text/javascript">
     $(document).ready(function () {
        $("#no_pemesanan").change(function () {
            var id= $(this).val();

            $.ajax({
                method:"get",
                url: "{{ route('pemesanan.request') }}",
                data: {"_token": "{{ csrf_token() }}", "id":id},
                dataType: 'json', 
                success:function (data) {
                    console.log(data);
                     $('#delivery_to').val(data.ship_to);
                     $('#payment_terms').val(data.payment_terms);
                },
                error:function () {

                }
            })

        });
    });
</script>
@endsection
