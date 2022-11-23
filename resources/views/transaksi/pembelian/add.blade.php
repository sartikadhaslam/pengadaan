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
                <h1 id="getting-started" class="link-heading">Tambah Pembelian</h1>
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
                <form action="{{url('pembelian/store')}}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="no_pembelian" class="form-label">Kode Pembelian (AUTO)</label>
                            <input type="text" class="form-control" id="no_pembelian" name="no_pembelian" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="tanggal_pembelian" class="form-label">Tanggal Pembelian</label>
                            <input type="date" class="form-control" id="tanggal_pembelian" name="tanggal_pembelian" value="<?php echo date('Y-m-d'); ?>" readonly>
                        </div>
                        <div class="mb-3">
                            <label for="no_pemesanan" class="form-label">No Pemesanan</label>
                            <select name="no_pemesanan" id="no_pemesanan" class="form-control">
                                <option>--Pilih Nomor Pemesanan--</option>
                                @foreach($getPemesananHeaderApprove as $getPemesananHeaderApprove)
                                <option value="{{ $getPemesananHeaderApprove->no_pemesanan }}">{{ $getPemesananHeaderApprove->no_pemesanan }}-{{ $getPemesananHeaderApprove->customer }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="id_principle" class="form-label">Principle</label>
                            <select name="id_principle" id="id_principle" class="form-control">
                                <option>--Pilih Principle--</option>
                                @foreach($getMasterPrincipleAll as $getMasterPrincipleAll)
                                <option value="{{ $getMasterPrincipleAll->id }}">{{ $getMasterPrincipleAll->kode_principle }}-{{ $getMasterPrincipleAll->nama_principle }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="alamat_principle" class="form-label">Alamat</label>
                            <textarea class="form-control" id="alamat_principle" name="alamat_principle"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="telepon_principle" class="form-label">Telepon</label>
                            <input type="text" class="form-control" id="telepon_principle" name="telepon_principle">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3">
                            <label for="fax_principle" class="form-label">Fax</label>
                            <input type="text" class="form-control" id="fax_principle" name="fax_principle">
                        </div>
                        <div class="mb-3">
                            <label for="term_condition" class="form-label">Term Condition</label>
                            <textarea class="form-control" id="editor" name="term_condition"></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="status" class="form-label">Status (AUTO)</label>
                            <input type="text" class="form-control" id="status" name="status" readonly>
                        </div>
                    </div>
                </div>
                    <button type="submit" class="btn btn-success ml-0">Simpan</button>
                    <a href="{{url('/pembelian')}}" style="color:#ffffff;" type="cancel" class="btn btn-secondary">Kembali</a>
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
