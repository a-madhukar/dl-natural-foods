@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order</div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="store">Name</label>
                            <p>{{ $product->name }}</p>
                        </div>

                        <div class="form-group">
                            <label for="store">Description</label>
                            <p>{{ $product->description }}</p>
                        </div>

                        <div class="form-group">
                            <label for="store">Unique Code</label>
                            <p>{{ $product->unq_code }}</p>
                        </div>

                        <div class="form-group">
                            <label for="store">QR Code</label>
                            <br>
                            <img src="/{{ $product->qr_code_path }}" alt="QR Code" width="200">
                            <br>
                            <a href="/products/{{ $product->unq_code }}/download-barcode" class="btn btn-primary">Download</a>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
