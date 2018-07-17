@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Edit Product</div>

                <div class="card-body">
                    <product-form :saved-product="{{ json_encode($product) }}" mode="edit"></product-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
