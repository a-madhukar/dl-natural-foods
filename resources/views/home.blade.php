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
                <div class="card-header">Orders</div>

                @if(isset($codes) && count($codes))
                <div>
                    <form class="row" method="GET" action="/home">
                        <div class="col-md-5">
                            <div class="form-group">
                                <label for="">Filter By Code:</label>
                                <select name="unq_code" id="" class="form-control">
                                    <option value="">All</option>
                                    @foreach($codes as $code)
                                        <option value="{{ $code }}" {{ $code == request()->unq_code ? 'selected' : '' }}>{{ $code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="col-md-4" style="display:flex; align-items:center;">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>
                    </form>
                </div>
                @endif

                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                            <th scope="col">Date</th>
                            <th scope="col">Code</th>

                            @if(auth()->user()->isAdmin())
                                <th scope="col">User</th>
                            @endif

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
                                    <a href="/home?{{ implode('&' ,request()->all()) . 'unq_code=' . $order->product->unq_code ?? '' }}">
                                        {{ $order->product->unq_code ?? '' }}
                                    </a>
                                </td>

                                @if(auth()->user()->isAdmin())
                                    <td>
                                        {{ $order->user->name }}
                                    </td>
                                @endif

                                <td>
                                    {{ $order->store_name }}
                                </td>

                                <td>
                                    {{ money_format('RM %i',$order->price) }}
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
                            @else
                            <tr>
                                <td class="text-center" colspan="{{ auth()->user()->isAdmin() ? 6 : 5 }}">No orders yet.</td>
                            </tr>
                            @endif
                        </tbody>
                    </table>
                </div>

                

            </div>

            <div class="text-" style="margin-top:10px; display:flex; justify-content:center;">
                {{ $orders->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
