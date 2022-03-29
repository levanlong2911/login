@extends('templates.duan.master')
@section('content')
    <div class="row justify-content-center my-5 form-signup">
        <form action="{{ route('user.reset.password') }}" method="post" class="col-md-6 bg-light p-3" autocomplete="off">
            @csrf
            @if (Session::get('fail'))
                <div class="alert alert-danger">
                    {{ Session::get('fail') }}
                </div>
            @endif
            @if (Session::get('success'))
                <div class="alert alert-success">
                    {{ Session::get('success') }}
                </div>
            @endif
            <h1 class="text-center text-uppercase h3 py-3">RESET PASSWORD</h1>
            <input type="hidden" name="token" value="{{ $token}}">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="1234@gmail.com" value="{{ $email ?? old('email') }}">
                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" placeholder="VD: Nguyenvanan11@" value="{{ old('password') }}">
                <span class="text-danger">@error('password'){{ $message }}@enderror</span>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Confirm Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="VD: Nguyenvanan11@" value="{{ old('password') }}">
                <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Reset password">
            <a href="{{ route('user.login') }}" style="text-decoration: none;" class="row justify-content-center">Login</a>
        </form>
    </div> 
@endsection