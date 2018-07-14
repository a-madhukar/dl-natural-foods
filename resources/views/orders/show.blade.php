@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Order</div>

                    <div class="card-body">

                        <div class="form-group">
                            <label for="store">Unique Code</label>
                            <p>{{ $order->product->unq_code }}</p>
                        </div>

                        <div class="form-group">
                            <label for="store">Date</label>
                            <p>{{ $order->date }}</p>
                        </div>

                        <div class="form-group">
                            <label for="store">Store</label>
                            <p>{{ $order->store_name }}</p>
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <p>{{ $order->quantity }}</p>
                        </div>

                        <div class="form-group">
                            <label for="price">Price Per Item</label>
                            <p>{{ $order->price }}</p>
                        </div>


                        <div class="form-group">
                            <label for="price">Comments</label>
                            <p>{{ $order->comments }}</p>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
