@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="text-right">
                <a href="/products/create" class="btn btn-primary">
                    New Product
                </a>
            </div>

            <hr>

            <div class="card">
                <div class="card-header">Products</div>

                @if(isset($codes) && count($codes))
                <div>
                    <form class="row" method="GET" action="/products">
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

                <table class="table">
                    <thead>
                        <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Code</th>
                        <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @if(isset($products) && count($products))
                        @foreach($products as $product)
                        <tr>
                            <td>
                                <a href="/home?unq_code={{ $product->unq_code }}">{{ $product->name }}</a>
                            </td>

                            <td>
                                {{ $product->unq_code }}
                            </td>

                            <td>
                                <div class="dropdown text-center">
                                    <button class="btn btn-outline-dark dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        Actions
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                        <a class="dropdown-item" href="/products/{{ $product->unq_code }}">View</a>
                                        <a class="dropdown-item" href="/products/{{ $product->unq_code }}/edit">Edit</a>
                                        <delete-button href="{{ '/products/' . $product->unq_code }}" 
                                        text="{{ 'Delete Product with code: ' . $product->unq_code }}"></delete-button> 
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        @else
                            <tr>
                                <td class="text-center" colspan="3">No products yet.</td>
                            </tr>
                        @endif
                    </tbody>
                </table>

                

            </div>

            <div class="text-" style="margin-top:10px; display:flex; justify-content:center;">
                {{ $products->links() }}
            </div>
        </div>
    </div>
</div>
@endsection
