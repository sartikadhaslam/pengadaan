@extends('layouts.app')

@section('content')
<div class="">
    <div class="documentation-container">
        <div class="docs-sidebar">
            @include('layouts.sidebar')  
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <h1 id="getting-started" class="link-heading">Ubah Master Principle</h1>
                <hr/>
                <form action="/master-principle/update/{{ $getMasterPrinciplebyId->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="nama_principle" class="form-label">Nama Principle</label>
                        <input type="text" class="form-control" id="nama_principle" name="nama_principle" value="{{ $getMasterPrinciplebyId->nama_principle }}">
                    </div>
                    <div class="mb-3">
                        <label for="alamat" class="form-label">Alamat</label>
                        <textarea class="form-control" id="alamat" name="alamat">{{ $getMasterPrinciplebyId->alamat }}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="text" class="form-control" id="email" name="email" value="{{ $getMasterPrinciplebyId->email }}">
                    </div>
                    <div class="mb-3">
                        <label for="no_telp" class="form-label">Nomor Telepon</label>
                        <input type="text" class="form-control" id="no_telp" name="no_telp" maxlength="13"  value="{{ $getMasterPrinciplebyId->no_telp }}">
                    </div>
                    <div class="mb-3">
                        <label for="fax" class="form-label">Nomor Fax</label>
                        <input type="text" class="form-control" id="fax" name="fax" value="{{ $getMasterPrinciplebyId->fax }}">
                    </div>
                    <div class="mb-3">
                        <label for="nama_pic" class="form-label">Nama PIC</label>
                        <input type="text" class="form-control" id="nama_pic" name="nama_pic" value="{{ $getMasterPrinciplebyId->nama_pic }}">
                    </div>
                    <div class="mb-3">
                        <label for="jabatan_pic" class="form-label">Jabatan PIC</label>
                        <input type="text" class="form-control" id="jabatan_pic" name="jabatan_pic"  value="{{ $getMasterPrinciplebyId->jabatan_pic }}">
                    </div>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <button type="cancel" class="btn btn-danger">Batal</button>
                </form>
            </div>    
        </div>  

    </div>
</div>
@endsection
