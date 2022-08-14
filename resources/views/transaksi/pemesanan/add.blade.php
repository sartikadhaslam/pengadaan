@extends('layouts.app')

@section('content')
<div class="">
    <div class="documentation-container">
        <div class="docs-sidebar">
            @include('layouts.sidebar')      
        </div>

        <div class="docs-container-content">
            <div class="docs-content-area">
                <h1 id="getting-started" class="link-heading">Tambah Pemesanan Oleh Customer</h1>
                <hr/>
                <form action="{{url('pemesanan/store')}}" method="post">
                @csrf
                    <div class="mb-3">
                        <label for="customer" class="form-label">Customer</label>
                        <select  class="form-control" id="customer" name="id_customer">
                            @foreach($customer as $v)
                            <option value="{{$v->id}}">{{$v->nama_customer}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="fax_customer" class="form-label">Fax Customer</label>
                        <input type="number" class="form-control" id="fax_customer" name="fax_customer">
                    </div>
                    <div class="mb-3">
                        <label for="ship_to" class="form-label">Ship to</label>
                        <textarea class="form-control" id="ship_to" name="ship_to"></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="delivery_deadline" class="form-label">Delivery Deadline</label>
                        <input type="date" class="form-control" id="delivery_deadline" name="delivery_deadline">
                    </div>
                    <div class="mb-3">
                        <label for="delivery_terms" class="form-label">Delivery Terms</label>
                        <input type="number" class="form-control" id="delivery_terms" name="delivery_terms">
                    </div>
                    <div class="mb-3">
                        <label for="payment_terms" class="form-label">Payment Terms</label>
                        <input type="number" class="form-control" id="payment_terms" name="payment_terms">
                    </div>
                    <div class="mb-3">
                        <label for="remark" class="form-label">Remark</label>
                        <textarea class="form-control" id="remark" name="remark"></textarea>
                    </div>
                    <button type="submit" class="btn btn-success">Simpan</button>
                    <button type="cancel" class="btn btn-danger">Batal</button>
                </form>
            </div>    
        </div>  

    </div>
</div>
@endsection
