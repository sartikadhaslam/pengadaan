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
                    <h5>MASTER</h5>
                    <ul>
                        <li><a href="{{url('/master-barang')}}">Master Barang</a></li>
                        <li><a href="{{url('/master-customer')}}">Master Customer</a></li>
                        <li><a href="{{url('/master-principle')}}">Master Principle</a></li>
                        <li><a href="{{url('/master-user')}}">Master User</a></li>
                    </ul>
                    
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
                <h1 id="getting-started" class="link-heading">Ubah Master User</h1>
                <hr/>
                <form action="/master-user/update/{{ $getMasterUserbyId->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="name" class="form-label">Nama User</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $getMasterUserbyId->name }}">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <textarea class="form-control" id="email" name="email">{{ $getMasterUserbyId->email }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="role" class="form-label">Role</label>
                        <select name="role" id="role"  class="form-control">
                            <option>--Pilih Role--</option>
                            <option value="pengadaan" <?php if($getMasterUserbyId->role == 'pengadaan'){echo 'selected';}?>>Bagian Pengadaan</option>
                            <option value="customer" <?php if($getMasterUserbyId->role == 'customer'){echo 'selected';}?>>Customer</option>
                            <option value="principle" <?php if($getMasterUserbyId->role == 'principle'){echo 'selected';}?>>Principle</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <a href="{{url('/master-user')}}" style="color:#ffffff;" type="cancel" class="btn btn-secondary">Kembali</a>
                </form>
            </div>    
        </div>  

    </div>
</div>
@endsection
