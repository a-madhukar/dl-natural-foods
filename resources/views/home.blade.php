@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Past Orders</div>

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Store</th>
                        <th scope="col">Price</th>
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
