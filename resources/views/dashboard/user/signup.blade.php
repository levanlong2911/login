@extends('templates.duan.master')
@section('content')
<div class="row justify-content-center my-5 form-signup">
    <form action="{{ route('user.signup') }}" method="post" class="col-md-6 bg-light p-3" autocomplete="off">
        @csrf
        @if(Session('success'))
            <div class="alert alert-success">
                {{ Session::get('success') }}
            </div>
        @endif
        @if (Session('fail'))
            <div class="alert alert-danger">
                {{ Session::get('fail') }}
            </div>
        @endif
        <h1 class="text-center text-uppercase h3 py-3">ĐĂNG KÝ TÀI KHOẢN</h1>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" name="name" id="name" class="form-control" placeholder="VD: Nguyễn Văn A" value="{{ old('name') }}">
            <span class="text-danger">@error('name'){{ $message }}@enderror</span>
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="text" name="email" id="email" class="form-control" placeholder="admin1234@gmail.com" value="{{ old('email') }}">
            <span class="text-danger">@error('email'){{ $message }}@enderror</span>
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control" placeholder="VD: Nguyenvanan11@" value="{{ old('password') }}">
            <span class="text-danger">@error('password'){{ $message }}@enderror</span>
        </div>
        <div class="form-group">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" placeholder="Nhập lại password" value="{{ old('cpassword') }}">
            <span class="text-danger">@error('password_confirmation'){{ $message }}@enderror</span>
        </div>
        <!-- <button type="submit" name="submit" onclick="validate();" >Đăng ký</button> -->
        <input type="submit" name="submit" class="btn btn-primary btn-block" value="Create new password">
        <a href="{{ route('user.login') }}" style="text-decoration: none;" class="row justify-content-center">Login</a>
    </form>
</div>
@endsection