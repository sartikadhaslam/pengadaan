@extends('layouts.app')

@section('content')
<div class="">
    <div class="documentation-container">
        <div class="docs-sidebar">
            @include('layouts.sidebar')  
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <h1 class="link-heading">Master Principle</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="pb-3">
                    <a href="{{url('/master-principle/add')}}" class="btn btn-primary text-white" role="button">Tambah</a>
                </div>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Principle</th>
                            <th scope="col">Alamat</th>
                            <th scope="col">No Telepon</th>
                            <th scope="col">Nama PIC</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($getMasterPrinciple as $masterPrinciple)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$masterPrinciple->nama_principle}}</td>
                            <td>{{$masterPrinciple->alamat}}</td>
                            <td>{{$masterPrinciple->no_telp}}</td>
                            <td>{{$masterPrinciple->nama_pic}}</td>
                            <td>
                                <div class="row">
                                    <div class="d-inline">
                                        <a class="btn btn-sm btn-success text-white" href="/master-principle/edit/{{ $masterPrinciple->id }}">Edit</a>
                                    </div>
                                    <div class="d-inline">
                                        <form method="POST" action="/master-principle/delete/{{ $masterPrinciple->id }}" onsubmit="return validateForm()">
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
            </div>    
        </div>  

    </div>
</div>
@endsection
