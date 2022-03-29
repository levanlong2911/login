@extends('templates.duan.master')
@section('content')
    <div class="row justify-content-center my-5 form-signup">
        @php
            if(isset($_COOKIE['login_email']) && isset($_COOKIE['login_pass'])){
                $login_email = $_COOKIE['login_email'];
                $login_pass = $_COOKIE['login_pass'];
                $is_remember = "checked = 'checked'";
            }else{
                $login_email = '';
                $login_pass = '';
                $is_remember = '';
            }
        @endphp
        <form action="{{ route('user.login') }}" method="post" class="col-md-6 bg-light p-3" autocomplete="off">
            @csrf
            @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
            @endif
            @if (Session::get('info'))
                <div class="alert alert-info">
                    {{ Session::get('info') }}
                </div>
            @endif
            <h1 class="text-center text-uppercase h3 py-3">ĐĂNG NHẬP</h1>
            
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="1234@gmail.com" value="{{ Session::get('verifiedEmail') ? Session::get('verifiedEmail') : old('email') }}{{ $login_email }}">
                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="VD: Nguyenvanan11@" value="{{ old('password') }}{{ $login_pass }}">
                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
            </div>
            <input type="checkbox" name="remember" id="remember" {{ $is_remember }}> Ghi nhớ tài khoản?
            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Login">
            <a href="{{ route('user.signup') }}" style="text-decoration: none;" class="row justify-content-center">Create new Account</a>
            <a href="{{ route('user.forgot.password') }}" style="text-decoration: none;" class="row justify-content-center">Forgot password</a>
        </form>
    </div> 
@endsection