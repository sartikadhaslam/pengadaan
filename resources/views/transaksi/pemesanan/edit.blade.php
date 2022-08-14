@extends('layouts.app')

@section('content')
<div class="">
    <div class="documentation-container">
        <div class="docs-sidebar">
            @include('layouts.sidebar')  
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <h1 id="getting-started" class="link-heading">Ubah Pemesanan Oleh Customer</h1>
                <hr/>
                @if (session()->has('message'))
                    <div class="alert alert-warning alert-dismissible fade show" role="alert">
                        {{ session('message') }}.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <form action="/pemesanan/update/{{ $data->id }}" method="post">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="customer" class="form-label">Customer</label>
                        <select  class="form-control" id="customer" name="id_customer" disabled>
                            @foreach($customer as $v)
                            <option value="{{$v->id}}" <?php if($data->id_customer == $v->id){echo 'selected';} ?>>{{$v->nama_customer}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="no_pemesanan" class="form-label">No Pemesanan</label>
                        <input type="text" class="form-control" id="payment_terms" value="{{$data->no_pemesanan}}" disabled>
                    </div>
                    <div class="mb-3">
                        <label for="status" class="form-label">Status</label>
                        <select  class="form-control" id="status" name="status">
                            <option value="proses" <?php if($data->status == 'proses'){echo 'selected';} ?>>Proses</option>
                            <option value="selesai" <?php if($data->status == 'selesai'){echo 'selected';} ?>>Selesai</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fax_customer" class="form-label">Fax Customer</label>
                        <input type="number" class="form-control" id="fax_customer" value="{{$data->fax_customer}}" name="fax_customer">
                    </div>
                    <div class="mb-3">
                        <label for="ship_to" class="form-label">Ship to</label>
                        <textarea class="form-control" id="ship_to" name="ship_to">{{$data->ship_to}}</textarea>
                    </div>
                    <div class="mb-3">
                        <label for="delivery_deadline" class="form-label">Delivery Deadline</label>
                        <input type="date" class="form-control" id="delivery_deadline" value="{{$data->delivery_deadline}}" name="delivery_deadline">
                    </div>
                    <div class="mb-3">
                        <label for="delivery_terms" class="form-label">Delivery Terms</label>
                        <input type="number" class="form-control" id="delivery_terms" value="{{$data->delivery_terms}}" name="delivery_terms">
                    </div>
                    <div class="mb-3">
                        <label for="payment_terms" class="form-label">Payment Terms</label>
                        <input type="number" class="form-control" id="payment_terms" value="{{$data->payment_terms}}" name="payment_terms">
                    </div>
                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea class="form-control" id="remark" name="remark">{{$data->remark}}</textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Ubah</button>
                    <button type="cancel" class="btn btn-danger">Batal</button>
                </form>
            </div>    
            
        </div>  

        <div class="docs-container-content">
            <div class="docs-content-area">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#myModal">
                    Tambah Pemesanan Oleh Customer
                </button>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">No</th>
                            <th scope="col">Nama Barang</th>
                            <th scope="col">Unit</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Total</th> 
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($detail as $v)
                        <tr>
                            <td>{{ $no++ }}</td>
                            <td>{{$v->nama_barang}}</td>
                            <td>{{$v->unit}}</td>
                            <td>{{$v->qty}}</td>
                            <td>{{$v->unit_price}}</td>
                            <td>{{$v->total}}</td>
                            <td>
                                <div class="row">
                                    <div class="d-inline">
                                        <form method="POST" action="/pemesanan_detail/delete/{{ $v->id }}" onsubmit="return validateForm()">
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

<!-- The Modal -->
<div class="modal" id="myModal">
    <div class="modal-dialog">
        <div class="modal-content text-dark">

        <!-- Modal Header -->
        <div class="modal-header">
            <h4 class="modal-title text-dark">Tambah Pemesanan Oleh Customer</h4>
            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
        </div>

        <!-- Modal body -->
        <div class="modal-body">
        <form action="{{url('pemesanan_detail/store')}}" method="post">
        @csrf
            <input type="hidden" name="id_pemesanan" value="{{$data->id}}"/>
            <div class="mb-3">
                <label for="unit" class="form-label">Unit</label>
                <input type="text" class="form-control" id="unit" name="unit" maxlength="5" >
            </div>
            <div class="mb-3">
                <label for="id_barang" class="form-label">Barang</label>
                <select  class="form-control" id="id_barang" name="id_barang">
                    @foreach($barang as $v)
                    <option value="{{$v->id}}">{{$v->nama_barang}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="qty" class="form-label">Quantity</label>
                <input type="number" class="form-control" id="qty" name="qty">
            </div>
            <button type="submit" class="btn btn-success">Simpan</button>
        </form>
        </div>

        <!-- Modal footer -->
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
        </div>

        </div>
    </div>
</div>
@endsection
