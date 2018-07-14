@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-right">
                <a href="/orders/create" class="btn btn-primary">
                    New Order
                </a>
            </div>

            <hr>

            <div class="card">
                <div class="card-header">Past Orders</div>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Store</th>
                        <th scope="col">Price</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($orders) && count($orders))
                        @foreach($orders as $order)
                        <tr>
                            <td>
                                {{ $order->date }}
                            </td>
                            <td>
                                {{ $order->store_name }}
                            </td>
                            <td>
                                {{ $order->price }}
                            </td>

                            <td>
                                <div class="dropdown text-center">
                                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="/orders/{{ $order->id }}">View</a>
                                        <a class="dropdown-item" href="/orders/{{ $order->id }}/edit">Edit</a>
                                        <a class="dropdown-item" href="#">Delete</a>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @endif
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
@endsection
