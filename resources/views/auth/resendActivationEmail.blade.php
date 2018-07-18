@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Activate Your Account') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="/account/send-activation-email" aria-label="{{ __('Activate Your Account') }}">
                        @csrf

                        <div class="form-group">
                            <p class="text-center">
                                We dropped you an email {{ auth()->check() ? 'at ' . auth()->user()->email : '' }}. Please click the link in the email to activate your account. 
                                <br>
                                <br>
                                You can click the button below if you'd like us to resend you the email.
                            </p>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Resend Activation Email') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
