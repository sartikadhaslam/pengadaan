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
                <h1 id="getting-started" class="link-heading">Tambah Penerimaan</h1>
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
                <form action="{{url('penerimaan/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_pembelian" class="form-label">Kode Pembelian</label>
                            <select name="no_pembelian" id="no_pembelian" class="form-control" >
                                <option>--Pilih No Pembelian --</option>
                                @foreach($pembelianHeader as $pembelianHeader)
                                <option value="{{$pembelianHeader->no_pembelian}}">{{$pembelianHeader->no_pembelian}} - {{$pembelianHeader->principle}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_penerimaan" class="form-label">Tanggal Penerimaan</label>
                            <input type="date" class="form-control" id="tanggal_penerimaan" name="tanggal_penerimaan" value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="surat_tagihan" class="form-label">Surat Tagihan</label><br>
                            <input type="file" id="surat_tagihan" name="surat_tagihan" accept=".pdf,.png,.jpg,.jpeg">
                        </div>
                        <div class="mb-3">
                            <label for="packing_list" class="form-label">Packing List</label><br>
                            <input type="file" id="packing_list" name="packing_list" accept=".pdf,.png,.jpg,.jpeg">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="nama_pengirim" class="form-label">Nama Pengirim</label>
                            <input type="text" class="form-control" id="nama_pengirim" name="nama_pengirim" required>
                        </div>
                        <div class="mb-3">
                            <label for="hp_pengirim" class="form-label">HP Pengirim</label>
                            <input type="text" class="form-control" id="hp_pengirim" name="hp_pengirim" required>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status (AUTO)</label>
                            <input type="text" class="form-control" id="status" name="status" readonly>
                        </div>
                    </div>
                </div>
                    <button type="submit" class="btn btn-success ml-0">Simpan</button>
                    <a href="{{url('/penerimaan')}}" style="color:#ffffff;" type="cancel" class="btn btn-secondary">Kembali</a>
                </form>
            </div>    
        </div>  

    </div>
</div>
<script type="text/javascript">
     $(document).ready(function () {
        $("#id_principle").change(function () {
            var id= $(this).val();

            $.ajax({
                method:"get",
                url: "{{ route('principle.request') }}",
                data: {"_token": "{{ csrf_token() }}", "id":id},
                dataType: 'json', 
                success:function (data) {
                    console.log(data);
                     $('#alamat_principle').val(data.alamat);
                     $('#telepon_principle').val(data.no_telp);
                     $('#fax_principle').val(data.fax);
                },
                error:function () {

                }
            })

        });
    });
</script>
@endsection
