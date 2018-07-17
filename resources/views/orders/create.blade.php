@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">New Order</div>

                <div class="card-body">
                    <order-form default-code="{{ $defaultCode }}"></order-form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
