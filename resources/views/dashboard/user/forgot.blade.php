@extends('templates.duan.master')
@section('content')
    <div class="row justify-content-center my-5 form-signup">
        <form action="{{ route('user.forgot.password') }}" method="post" class="col-md-6 bg-light p-3" autocomplete="off">
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
            <h1 class="text-center text-uppercase h3 py-3">FORGOT PASSWORD</h1>
            <p>Nhập địa chỉ email bạn đã đăng ký, chúng tôi sẻ gửi liên kết qua email để bạn đặt lại mật khẩu.</p>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="text" name="email" id="email" class="form-control" placeholder="1234@gmail.com" value="{{ old('email') }}">
                <span class="text-danger">@error('email'){{ $message }}@enderror</span>
            </div>
            <input type="submit" name="submit" class="btn btn-primary btn-block" value="Send reset passord link">
            <a href="{{ route('user.login') }}" style="text-decoration: none;" class="row justify-content-center">Login</a>
        </form>
    </div> 
@endsection