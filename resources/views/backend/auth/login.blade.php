@extends('backend.auth.layout')
@section('title', 'Login')

@section('content')
    <div class="login-box ptb--100">
        <form method="POST" action="{{ route('admin.login.submit') }}">
            @csrf
            <div class="login-form-head">
                <h4>Sign In</h4>
            </div>
            <div class="login-form-body">
                <div class="form-gp">
                    <label for="exampleInputEmail1">Email/Username</label>
                    <input type="text" id="exampleInputEmail1" name="email">
                    <i class="ti-email"></i>
                    <div class="text-danger">
                        @error('email')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="form-gp">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name="password" id="exampleInputPassword1">
                    <i class="ti-lock"></i>
                    <div class="text-danger">
                        @error('password')
                            {{ $message }}
                        @enderror
                    </div>
                </div>
                <div class="row mb-4 rmber-area">
                    <div class="col-6">
                        <div class="custom-control custom-checkbox mr-sm-2">
                            <input type="checkbox" name="remember" class="custom-control-input" id="customControlAutosizing">
                            <label class="custom-control-label" for="customControlAutosizing">Remember Me</label>
                        </div>
                    </div>
                    <div class="col-6 text-right">
                        @if (Route::has('admin.password.request'))
                            <a href="{{ route('admin.password.request') }}">
                                {{ __('Forgot your password?') }}
                            </a>
                        @endif
                    </div>
                </div>
                <div class="submit-btn-area">
                    <button id="form_submit" type="submit">Submit <i class="ti-arrow-right"></i></button>
                </div>
            </div>
        </form>
    </div>
@endsection
