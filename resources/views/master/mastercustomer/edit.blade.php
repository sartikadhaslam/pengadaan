@extends('layouts.app')

@section('content')
<div class="">
    <div class="documentation-container">
        <div class="docs-sidebar">
            @include('layouts.sidebar')  
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <h1 id="getting-started" class="link-heading">Ubah Master Customer</h1>
                <hr/>
                <form action="/master-customer/update/{{ $getMasterCustomerbyId->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_customer" class="form-label">Nama Customer</label>
                        <input type="text" class="form-control" id="nama_customer" name="nama_customer" value="{{ $getMasterCustomerbyId->nama_customer }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat" value="{{ $getMasterCustomerbyId->alamat }}">{{ $getMasterCustomerbyId->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $getMasterCustomerbyId->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" maxlength="13"  value="{{ $getMasterCustomerbyId->no_telp }}">
                    </div>
                    <div class="mb-3">
                        <label for="fax" class="form-label">Nomor Fax</label>
                        <input type="text" class="form-control" id="fax" name="fax" value="{{ $getMasterCustomerbyId->fax }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama_pic" class="form-label">Nama PIC</label>
                        <input type="text" class="form-control" id="nama_pic" name="nama_pic" value="{{ $getMasterCustomerbyId->nama_pic }}">
                    </div>
                    <div class="mb-3">
                        <label for="jabatan_pic" class="form-label">Jabatan PIC</label>
                        <input type="text" class="form-control" id="jabatan_pic" name="jabatan_pic"  value="{{ $getMasterCustomerbyId->jabatan_pic }}">
                    </div>
                    <div class="mb-3">
                        <label for="payment_terms" class="form-label">Payment Terms</label>
                        <input type="number" class="form-control" id="payment_terms" name="payment_terms" value="{{ $getMasterCustomerbyId->payment_terms }}">
                    </div>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <button type="cancel" class="btn btn-danger">Batal</button>
                </form>
            </div>    
        </div>  

    </div>
</div>
@endsection
