@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Order</div>

                <div class="card-body">
                    <form action="/orders" method="POST">

                        {{ csrf_field() }}

                        <div class="form-group">
                            <label for="store">Date</label>
                            <input type="date" class="form-control" name="date">
                        </div>

                        <div class="form-group">
                            <label for="store">Store</label>
                            <input type="text" class="form-control" name="store_name">
                        </div>

                        <div class="form-group">
                            <label for="quantity">Quantity</label>
                            <input type="number" class="form-control" min="0" name="quantity">
                        </div>

                        <div class="form-group">
                            <label for="price">Price Per Item</label>
                            <input type="number" class="form-control" min="0" name="price">
                        </div>


                        <div class="form-group">
                            <label for="price">Comments</label>
                            <textarea name="comments" class="form-control" id="" cols="30" rows="10"></textarea>
                        </div>

                        <div class="form-group">
                            <button class="btn btn-primary form-control" type="submit">
                                Submit
                            </button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
